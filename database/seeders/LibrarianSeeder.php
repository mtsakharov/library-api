<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Librarian;
use Illuminate\Database\Seeder;

class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Librarian::factory(2)->create();
    }
}
