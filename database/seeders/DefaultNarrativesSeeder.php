<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class DefaultNarrativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('default_narratives')->truncate();  
        $json = File::get("database/data/DefaultNarratives.json");
        $defaultNarratives = json_decode($json);
        foreach ($defaultNarratives as $defaultNarrative) {
            if (!empty($defaultNarrative->narratives)) {
                foreach ($defaultNarrative->narratives as $value) {
                    DB::table('default_narratives')->insert([
                        'cat_id' => $defaultNarrative->cat_id,
                        'sub_cat_id' => $defaultNarrative->sub_cat_id,
                        'narratives_title' => $value->title,
                        'narratives_text' =>$value->text,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
