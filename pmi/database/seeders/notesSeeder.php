<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class notesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Note::create([
            'title' => 'Japanisch lernen',
            'description' => 'hörverständnis, vokabeln',
            'status' => 'todo',
        ]);
        Note::create([
            'title' => 'Einkaufen',
            'description' => 'Burger Bun, Salat, Patties',
            'status' => 'todo',
        ]);

        Note::factory()->count(3)->create();
    }
}
