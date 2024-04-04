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
        $note = DB::table('notes')->where('deleted_at', null)->orderByDesc('created_at')->first();
        if (!$note) {
            dd('Note not found');
            return;
        }
        \App\Models\Task::factory(5)->create([
            'note_id' => $note->id
        ]);
        dd("Add tasks to note#" . $note->id);
    }
}
