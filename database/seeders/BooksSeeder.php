<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->pluck('id');

        foreach ($categories as $categoryId) {
            DB::table('books')->insert([
                'title' => 'Sample Book',
                'author' => 'Sample Author',
                'category_id' => $categoryId,
                'date_of_publication' => Carbon::now(),
            ]);
        }
    }
}
