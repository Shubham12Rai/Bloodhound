<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FormcategorySeeder::class);
        $this->call(FormsubcategorySeeder::class);
        $this->call(DefaultNarrativesSeeder::class);
        $this->call(QuestionSeeder::class);
        // $this->call(InspectorTableSeeder::class);
    }
}
