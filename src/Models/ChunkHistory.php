<?php

namespace Aminrafiei\Chunker\Models;

use Illuminate\Database\Eloquent\Model;

class ChunkHistory extends Model
{
    const CREATED = 'CREATED';
    const IN_PROGRESS = 'IN_PROGRESS';
    const DONE = 'DONE';
    const CANCELED = 'CANCELED';

    protected $fillable = ['id', 'name', 'type', 'total_size', 'total_chunks'];
    public $incrementing = false;
}
