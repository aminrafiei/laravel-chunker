<?php

namespace Aminrafiei\Chunker\Contracts;

use Aminrafiei\Chunker\Exceptions\ChunkHistoryNotFoundException;
use Aminrafiei\Chunker\Exceptions\TooMuchChunkException;
use Aminrafiei\Chunker\Models\ChunkHistory;

interface ChunkerContract
{
    /**
     * @param string $fileName
     * @param string $fileType
     * @param int $totalChunks
     * @param int $totalSize
     * @return ChunkHistory
     */
    public function init(string $fileName, string $fileType, int $totalChunks, int $totalSize): ChunkHistory;

    /**
     * @param string $id
     * @param int $chunkNumber
     * @param $file
     * @return mixed
     * @throws TooMuchChunkException
     * @throws ChunkHistoryNotFoundException
     */
    public function progress(string $id, int $chunkNumber, $file);

    /**
     * @param string $id
     * @return mixed
     */
    public function done(string $id);

    /**
     * @param string $id
     * @throws ChunkHistoryNotFoundException
     * @return mixed
     */
    public function cancel(string $id);
}
