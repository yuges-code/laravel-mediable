<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Yuges\Mediable\Managers\MediaManager;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(protected string $table = 'media')
    {
        $this->$table = MediaManager::getMediaTable();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->morphs('mediable');
            $table->string('collection')->index();
            $table->string('disk', 32);
            $table->string('directory');
            $table->string('filename');
            $table->string('extension', 32);
            $table->string('mime', 128);
            $table->unsignedBigInteger('size');
            $table->boolean('temporary')->index();
            $table->json('manipulations')->nullable();
            $table->json('conversions')->nullable();
            $table->json('responsive')->nullable();
            $table->json('properties')->nullable();
            $table->json('placeholders')->nullable();
            $table->unsignedBigInteger('order')->index();

            $table->unique(['disk', 'directory', 'filename', 'extension']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
