<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * Generates fake data for a Note model.
     *
     * Generated fields:
     *
     * - title:
     *   Random short sentence used as the note title
     *
     * - description:
     *   Random paragraph used as the note content
     *
     * - status:
     *   Randomly assigned note status
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(1),
            'description' => fake()->paragraph(3),
            'status' => fake()->randomElement(['todo', 'done']),
        ];
    }
}
