<?php

use Aminrafiei\Chunker\Models\ChunkHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChunkHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chunk_histories', function (Blueprint $table) {
            $table->string('id')->unique()->index()->primary();
            $table->string('name');
            $table->string('type');
            $table->unsignedInteger('total_chunks')->default(0);
            $table->unsignedInteger('received_chunks')->default(0);
            $table->unsignedInteger('total_size');
            $table->string('status')->default(ChunkHistory::CREATED);
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chunk_histories');
    }
}
