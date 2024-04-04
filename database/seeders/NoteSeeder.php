<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Number;
use Illuminate\Support\Str;


class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Note::factory(10)->create();
        // for ($i=0; $i < 20; $i++) {
        //     # code...
        //     DB::table('notes')->insert([
        //         'title' => Str::random(),
        //         'content' => Str::random(128),
        //         'user_id' => 2
        //     ]);
        // }

    }
}
