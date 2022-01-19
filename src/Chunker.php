<?php

namespace Aminrafiei\Chunker;

use Aminrafiei\Chunker\Contracts\ChunkerContract;
use Aminrafiei\Chunker\Contracts\FileServiceContract;
use Aminrafiei\Chunker\Exceptions\ChunkHistoryNotFoundException;
use Aminrafiei\Chunker\Exceptions\NotEnoughChunkException;
use Aminrafiei\Chunker\Exceptions\TooMuchChunkException;
use Aminrafiei\Chunker\Models\ChunkHistory;
use Aminrafiei\Chunker\Services\ChunkService;
use Aminrafiei\Chunker\ValueObjects\ChunkResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Chunker implements ChunkerContract
{
    const FINAL_NAME = 'final';

    /**
     * @var FileServiceContract
     */
    private $fileService;

    /**
     * @var ChunkService
     */
    private $chunkService;

    public function __construct(FileServiceContract $fileService, ChunkService $chunkService)
    {
        $this->fileService = $fileService;
        $this->chunkService = $chunkService;
    }

    public function init(string $fileName, string $fileType, int $totalChunks, int $totalSize): ChunkHistory
    {
        if (!file_exists(config('chunker.save_path'))) {
            mkdir(config('chunker.save_path'), 0776, true);
        }

        return $this->chunkService->createChunkHistory($fileName, $fileType, $totalChunks, $totalSize);
    }

    /**
     * @throws TooMuchChunkException
     * @throws ChunkHistoryNotFoundException
     */
    public function progress(string $id, int $chunkNumber, $file)
    {
        $chunkHistory = $this->checkChunkStatus($id);
        if ($chunkHistory->total_chunks < $chunkNumber) {
            throw new TooMuchChunkException();
        }

        DB::transaction(function () use ($chunkHistory, $chunkNumber, $file, $id) {
            $this->chunkService->updateChunkHistory($chunkHistory, $chunkNumber);
            $this->fileService->put(
                config('chunker.save_path') . '/' . $id,
                $file,
                $id . '_' . $chunkNumber
            );
        });
    }

    /**
     * @throws NotEnoughChunkException|ChunkHistoryNotFoundException
     */
    public function done(string $id)
    {
        $chunkHistory = $this->checkChunkStatus($id, [ChunkHistory::CANCELED, ChunkHistory::CREATED]);
        if ($chunkHistory->received_chunks != $chunkHistory->total_chunks) {
            throw new NotEnoughChunkException();
        }

        $path = config('chunker.save_path') . '/' . $id;
        $fileName = $path . "/" . self::FINAL_NAME;
        if ($chunkHistory->status == ChunkHistory::DONE && file_exists($fileName)) {
            return new ChunkResponse($chunkHistory);
        }

        DB::transaction(function () use ($fileName, $path, $chunkHistory) {
            $this->deleteFile($fileName);
            $this->mergeChunkedFiles($path);
            $this->chunkService->doneChunkHistory($chunkHistory, $fileName);
            $this->deleteChunkedFiles($path);
        });

        return new ChunkResponse($chunkHistory);
    }

    /**
     * @throws ChunkHistoryNotFoundException
     */
    public function cancel(string $id)
    {
        $chunkHistory = $this->checkChunkStatus($id, [ChunkHistory::CANCELED, ChunkHistory::DONE]);
        $path = config('chunker.save_path') . '/' . $id;

        DB::transaction(function () use ($path, $chunkHistory) {
            $this->deleteChunkedFiles($path);
            $this->chunkService->cancelChunkHistory($chunkHistory);
        });
    }

    /**
     * @param string $id
     * @return mixed
     * @throws ChunkHistoryNotFoundException
     */
    private function checkChunkStatus(string $id, array $status = [ChunkHistory::DONE, ChunkHistory::CANCELED])
    {
        if (
            is_null($chunkHistory = ChunkHistory::find($id)) ||
            in_array($chunkHistory->status, $status, true)
        ) {
            throw new ChunkHistoryNotFoundException();
        }

        return $chunkHistory;
    }

    /**
     * @param string $path
     */
    private function mergeChunkedFiles(string $path): void
    {
        foreach (glob($path . '/*') as $chunk) {
            $this->fileService->put(
                $path,
                new \SplFileInfo($chunk),
                self::FINAL_NAME,
                FileServiceContract::APPEND
            );
        }
    }

    private function deleteChunkedFiles(string $path): void
    {
        foreach (glob($path . '/*') as $chunk) {
            if (Str::contains($chunk, self::FINAL_NAME)) {
                continue;
            }
            $this->deleteFile($chunk);
        }
    }

    /**
     * @param string $fileName
     */
    private function deleteFile(string $fileName): void
    {
        if (file_exists($fileName)) {
            unlink($fileName);
        }
    }
}
