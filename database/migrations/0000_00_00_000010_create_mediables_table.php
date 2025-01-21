<?php

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Yuges\Mediable\Managers\MediaManager;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(protected string $table = 'mediables')
    {
        $this->$table = MediaManager::getMediableTable();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignIdFor(MediaManager::getMediaClass())->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->morphs('mediable');
            $table->string('collection')->index();
            $table->unsignedBigInteger('order')->index();

            $table->unique(['media_id', 'mediable_type', 'mediable_id', 'collection']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
