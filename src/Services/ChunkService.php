<?php

namespace Aminrafiei\Chunker\Services;


use Aminrafiei\Chunker\Models\ChunkHistory;

class ChunkService
{
    public function updateChunkHistory(ChunkHistory $chunkHistory, int $chunkNumber)
    {
        $chunkHistory->received_chunks = $chunkNumber;
        $chunkHistory->status = ChunkHistory::IN_PROGRESS;
        $chunkHistory->save();
        return $chunkHistory;
    }

    public function doneChunkHistory(ChunkHistory $chunkHistory, $path)
    {
        $chunkHistory->status = ChunkHistory::DONE;
        $chunkHistory->path = $path;
        $chunkHistory->save();
        return $chunkHistory;
    }

    public function cancelChunkHistory(ChunkHistory $chunkHistory)
    {
        $chunkHistory->status = ChunkHistory::CANCELED;
        $chunkHistory->save();
        return $chunkHistory;
    }

    public function createChunkHistory($fileName, $fileType, $totalChunks, $totalSize, $mimeType = null)
    {
        return ChunkHistory::firstOrCreate([
            'id'           => md5(uniqid() . '_' . $fileName),
            'name'         => trim($fileName),
            'type'         => $fileType,
            'total_chunks' => $totalChunks,
            'total_size'   => $totalSize,
            'mime_type'   => $mimeType,
        ]);
    }
}
