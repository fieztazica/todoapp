<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $note = DB::table('notes')->first();
        if (!$note) {
            dd('Note not found');
            return;
        }
        for ($i = 0; $i < 5; $i++) {
            # code...
            DB::table('tasks')->insert([
                'name' => Str::random(),
                'description' => Str::random(128),
                'note_id' => $note->id
            ]);
        }
        dd("Add tasks to note#" . $note->id);
    }
}
