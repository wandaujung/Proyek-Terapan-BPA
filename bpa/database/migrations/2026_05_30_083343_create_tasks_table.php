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
    Schema::create('tasks', function (Blueprint $table) {

        $table->id();

        $table->string('title');
        $table->text('description')->nullable();

        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();

        $table->string('brief_link')->nullable();
        $table->string('submission_link')->nullable();

        $table->unsignedBigInteger('user_id');

        $table->enum('status', [
            'todo',
            'progress',
            'review',
            'done'
        ])->default('todo');

        $table->enum('review_status', [
            'pending',
            'approved',
            'revision'
        ])->nullable();

        $table->string('manager_email')->nullable();

        $table->timestamps();

        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
