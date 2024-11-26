<?php

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    protected string $table = 'mediables';

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignIdFor(Media::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->ulidMorphs('mediable');
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
