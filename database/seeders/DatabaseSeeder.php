<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Board;
use App\Models\Dream;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "fullname" => "Muhammad Hidayat",
            "username" => "masday",
            "password" => bcrypt("masday")
        ]);

        Board::create([
            "username" => "masday",
            "title" => "Justice Me",
            "publish" => true,
            "password" => null
        ]);

        Dream::create([
            "board_id" => 1,
            "username" => "masday",
            "text" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            "incognito" => false,
            "top" => 30,
            "left" => 30,
            "background" => "#30336b",
            "color" => "#ffffff",
        ]);
    }
}
