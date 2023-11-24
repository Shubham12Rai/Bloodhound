<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_categories')->insert([
            ['cat_name' => 'Site', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Roof', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Exterior', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Decks, Exterior Structures', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Structure', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Electrical', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Plumbing', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Heating & Cooling', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Insulation & Ventilation', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Interior', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_name' => 'Summary', 'status' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
