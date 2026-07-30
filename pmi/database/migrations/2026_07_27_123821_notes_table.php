<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the database migrations.
     *
     * Creates the "notes" table with the required columns.
     *
     * Table structure:
     *
     * - id:
     *   Auto-incrementing primary key
     *
     * - title:
     *   Short text field containing the note title
     *
     * - description:
     *   Long text field containing the note content
     *
     * - status:
     *   Current state of the note (default: todo)
     *
     * - timestamps:
     *   Automatically creates created_at and updated_at columns
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('notes', function(Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('title',30);
            $table->mediumText('description');
            $table->string('status')->default('todo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
