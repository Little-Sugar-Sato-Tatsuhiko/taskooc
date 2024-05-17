<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_diagram_lists', function (Blueprint $table) {
            $table->id();
            $table->string('task_diagram_token')->comment('ダイアグラムトークン');
            $table->string('name')->comment('タスク名');
            $table->string('task_member')->comment('責任者');
            $table->date('deadline')->comment('締切日');
            $table->text('note')->comment('メモ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_diagram_lists');
    }
};
