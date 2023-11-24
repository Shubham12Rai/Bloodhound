<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FormsubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_sub_categories')->insert([
            ['cat_id' => 1, 'sub_cat_name' => "Grading & Drainage", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 1, 'sub_cat_name' => "Walks & Drives", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 2, 'sub_cat_name' => "Roof Covering", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 2, 'sub_cat_name' => "Roof Drainage", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 2, 'sub_cat_name' => "Skylights", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 2, 'sub_cat_name' => "Chimney", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 3, 'sub_cat_name' => "Walls, Soffits & Fascia", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 3, 'sub_cat_name' => "Windows", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 3, 'sub_cat_name' => "Doors", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 4, 'sub_cat_name' => "Decks, Porches, Balconies", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 4, 'sub_cat_name' => "Detached Structure", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 5, 'sub_cat_name' => "General Construction", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 6, 'sub_cat_name' => "Service Entrance, Panels & Main Disconnect", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 6, 'sub_cat_name' => "Circuit Wiring & Distribution", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 7, 'sub_cat_name' => "Main Shut-off", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 7, 'sub_cat_name' => "Distribution Plumbing", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 7, 'sub_cat_name' => "Fixtures & Faucets", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 7, 'sub_cat_name' => "Drain, Waste & Vent Piping", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 7, 'sub_cat_name' => "Ejector Pump", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 7, 'sub_cat_name' => "Domestic Hot Water", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 8, 'sub_cat_name' => "Principal Heat", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 8, 'sub_cat_name' => "Supplementary Heat", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 8, 'sub_cat_name' => "Fuel Storage", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 8, 'sub_cat_name' => "Wood Burning Fireplaces", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 8, 'sub_cat_name' => "Wood Burning Stoves", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 9, 'sub_cat_name' => "Attics", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 9, 'sub_cat_name' => "Exterior Walls", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 9, 'sub_cat_name' => "Crawlspaces", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 9, 'sub_cat_name' => "Mechanical Ventilation", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 10, 'sub_cat_name' => "Walls, Floors, Doors & Stairways", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 10, 'sub_cat_name' => "Kitchens", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 10, 'sub_cat_name' => "Bathrooms", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 10, 'sub_cat_name' => "Laundry Equipment", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 10, 'sub_cat_name' => "Garage Interior", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 10, 'sub_cat_name' => "Rodents, Pests", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 10, 'sub_cat_name' => "Smoke/Carbon Monoxide Alarms", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 11, 'sub_cat_name' => "Subcategory for Summary", 'status' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
