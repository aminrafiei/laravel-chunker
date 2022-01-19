<?php

namespace Aminrafiei\Chunker\ValueObjects;

use Aminrafiei\Chunker\Chunker;

class ChunkResponse
{
    protected $realPath;
    protected $path;
    protected $type;

    public function __construct($id, $type)
    {
        $this->realPath = config('chunker.save_path') . '/' . $id . '/' . Chunker::FINAL_NAME;
        $this->path = $id . '/' . Chunker::FINAL_NAME;
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRealPath()
    {
        return $this->realPath;
    }

    /**
     * @param mixed $realPath
     */
    public function setRealPath($realPath): void
    {
        $this->realPath = $realPath;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }
}
