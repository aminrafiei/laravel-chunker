<?php

namespace Aminrafiei\Chunker\ValueObjects;

use Aminrafiei\Chunker\Chunker;
use Aminrafiei\Chunker\Models\ChunkHistory;

class ChunkResponse
{
    protected $id;
    protected $name;
    protected $size;
    protected $created_at;
    protected $realPath;
    protected $path;
    protected $type;

    public function __construct(ChunkHistory $chunkHistory)
    {
        $this->id = $chunkHistory->id;
        $this->name = $chunkHistory->name;
        $this->size = $chunkHistory->total_size;
        $this->created_at = $chunkHistory->created_at;
        $this->realPath = config('chunker.save_path') . '/' . $chunkHistory->id . '/' . Chunker::FINAL_NAME;
        $this->path = $chunkHistory->id . '/' . Chunker::FINAL_NAME;
        $this->type = $chunkHistory->type;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
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
