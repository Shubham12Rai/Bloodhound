<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            ['cat_id' => null, 'sub_cat_id' => 1, 'question_name' => "Surface grading", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 1, 'question_name' => "Roof water discharge", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 1, 'question_name' => "Foundation wall damp-proofing/membrane", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 1, 'question_name' => "Below grade perimeter drains", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 1, 'question_name' => "Visible above grade materials", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 1, 'question_name' => "Slab/floor drain", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 1, 'question_name' => "Foundation or below grade seepage", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 2, 'question_name' => "Driveways", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 2, 'question_name' => "Walkways Leading to Dwelling Entrance", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 2, 'question_name' => "Retaining Walls When Likely to Affect the Home", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 3, 'question_name' => "Roof Covering", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 3, 'question_name' => "Typical Service Life According to Industry", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 3, 'question_name' => "Est Current Life Stages", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 3, 'question_name' => "Precise Installation Date of Roof Covering", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 3, 'question_name' => "Method used to Inspect the Roof", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 3, 'question_name' => "Leaks detected", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 4, 'question_name' => "Roof Water Management", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 5, 'question_name' => "Skylight Styles", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 5, 'question_name' => "Leaks Detected", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 6, 'question_name' => "Chimney Construction", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 6, 'question_name' => "Flues Appears Lined", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 7, 'question_name' => "Wall Coverings:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 7, 'question_name' => "Roof Extension, Upper Wall Protection", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 7, 'question_name' => "Soffit Finishes:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 7, 'question_name' => "Method Used to Inspect the Exterior Wall Elevations:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 8, 'question_name' => "Window Construction:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 8, 'question_name' => "Indication of Perished Air-Seals (fogged glass):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 8, 'question_name' => "Methods Used to Inspect Windows:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 9, 'question_name' => "Main Unit Entry Door:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 9, 'question_name' => "Secondary Doors:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 9, 'question_name' => "Garage Doors:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 10, 'question_name' => "Deck, Balcony Construction:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 10, 'question_name' => "Walking Surfaces:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 10, 'question_name' => "Guards and Railings:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 10, 'question_name' => "Gates:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 10, 'question_name' => "Fences:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 10, 'question_name' => "Additional Detached structures:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 11, 'question_name' => "Building Type:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 11, 'question_name' => "General Construction:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 11, 'question_name' => "Slab/ Floor:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 11, 'question_name' => "Conditioned/ Heated Space:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 11, 'question_name' => "Insulated:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 12, 'question_name' => "Foundation:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 12, 'question_name' => "Configuration:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 12, 'question_name' => "Superstructure:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 12, 'question_name' => "Floor Structure:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 12, 'question_name' => "Exterior Wall Structure:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 12, 'question_name' => "Ceiling Structure:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 12, 'question_name' => "Roof Structure:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Service Entrance:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Service Voltage Rating:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Service Amperage Rating:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Main Disconnect Location:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Service Panel Manufacturer:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Service Panel Max Rating:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Over Current Protection/ Disconnects:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Room for Additional Breakers:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 13, 'question_name' => "Sub Panel Locations:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 14, 'question_name' => "Circuit Wiring Methods:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 14, 'question_name' => "Exterior Outlets GFCI Protected (ground level):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 14, 'question_name' => "Bathroom Outlets GFCI Protected:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 14, 'question_name' => "Kitchen Outlets GFCI Protected (within 1.5 M of sinks):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 14, 'question_name' => "Arc Fault Circuit Interrupters Present (AFCI):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 14, 'question_name' => "Lights, Switches and Receptacles:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 15, 'question_name' => "Visible Service Entrance Piping:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 15, 'question_name' => "Main Shut-off Valve:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 15, 'question_name' => "Location of Main Shut-off Valve:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 15, 'question_name' => "Pressure Reducer Valve (PRV) Installed:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 15, 'question_name' => "Leaks Detected:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 16, 'question_name' => "Visible Distribution Piping Materials:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 16, 'question_name' => "Leaks Detected:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 17, 'question_name' => "Fixtures, Faucets, Taps, Exterior Hoses-bibs:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 17, 'question_name' => "Flush Adequacy of Toilets; Toilet Seats/Lids:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 17, 'question_name' => "Stored Items Blocked Visibility Under Cabinets:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 17, 'question_name' => "Leaks Detected:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 18, 'question_name' => "Visible Drain, Waste and Vent Piping:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 18, 'question_name' => "Main Stack:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 18, 'question_name' => "Leaks Detected:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 19, 'question_name' => "Pump Location:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 19, 'question_name' => "Vented to the Exterior:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 19, 'question_name' => "Backflow Preventer Installed:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 19, 'question_name' => "Pump Failure Alarm Installed:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 19, 'question_name' => "Methods Used to Inspect Ejector Pump:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "System Type and Energy Source:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Manufactured by:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Est. Date of Manufacture:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Typical Service Life According to Industry:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Tank Capacity:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Tank Installed on a Drain-pan:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Floor Drain in the Area:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Seismic Straps (for tanks):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Venting Materials:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Combustion Air Sources:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 20, 'question_name' => "Fuel Shut-off Location:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "System Type/ Energy Source:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Heating and/or Cooling Methods:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Manufactured by:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Est. Date of Manufacture:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Typical Approx. Service Life According to Industry:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Exhaust Venting Materials:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Exhaust Venting Methods:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Combustion Air Sources:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Fuel Shut-off Location:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 21, 'question_name' => "Other Supplementary Heat:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "System Type and Energy Source:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Heating and\/or Cooling Methods:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Manufactured by:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Est. Date of Manufacture:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Typical Approx. Service Life According to Industry:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Exhaust Venting Materials:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Exhaust Venting Methods:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Combustion Air Sources:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Fuel Shut-off Location:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 22, 'question_name' => "Heating and/or Cooling Methods:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 23, 'question_name' => "Type:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 23, 'question_name' => "Location:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 23, 'question_name' => "Est. Date of Manufacture:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 23, 'question_name' => "Capacity:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 23, 'question_name' => "Shell Thickness:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 24, 'question_name' => "Fireplace Construction:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 24, 'question_name' => "Chimney Construction:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 24, 'question_name' => "Flues Appear Lined:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 24, 'question_name' => "Combustion Air Source:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 25, 'question_name' => "Type:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 25, 'question_name' => "Manufacturer:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 25, 'question_name' => "Est. Date of Manufacture:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 25, 'question_name' => "Venting Materials:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Attic Access Location(s):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Method used to Inspect Accessible Attic Areas:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Approximate Visible Attic Interior:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Insulation Materials:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Approximate Insulation Depth:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Visible Vapour Retarder(s):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Method Used to Spot Check Attic Floor:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Attic Intake Ventilation:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 26, 'question_name' => "Attic Exhaust Ventilation:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 27, 'question_name' => "Visible Insulation:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 27, 'question_name' => "Visible Vapour Retarders:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 27, 'question_name' => "The Above Materials Were Visible at:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Method Used to Inspect Crawlspace Areas:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Approximate Visible Crawlspace Interior:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Location of Crawlspace Access:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Condition or Unconditioned Space:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Heat Source:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Insulation Materials:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Ventilation Methods:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 28, 'question_name' => "Ground Cover:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 29, 'question_name' => "Bathrooms Equipped with Exhaust Fans:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 29, 'question_name' => "Kitchens Equipped with Exhaust Fans:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 29, 'question_name' => "De-Humidistat Location(s):", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 29, 'question_name' => "Continuous Ventilation System:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 30, 'question_name' => "Visibility:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 30, 'question_name' => "Wall Finishes:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 30, 'question_name' => "Ceiling Finishes", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 30, 'question_name' => "Primary Floor Coverings", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 30, 'question_name' => "Interior Doors", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 30, 'question_name' => "Interior Stairs", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 30, 'question_name' => "Central Vacuum System", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 31, 'question_name' => "Counter Tops", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 31, 'question_name' => "Cabinet Fronts:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 31, 'question_name' => "Stove Operational:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 31, 'question_name' => "Refrigerator Operational:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 31, 'question_name' => "Dishwasher Operational:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 31, 'question_name' => "Dishwasher Leaks Detected:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 31, 'question_name' => "Microwave Operational:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 32, 'question_name' => "Counter Tops", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 32, 'question_name' => "Cabinet fronts", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 32, 'question_name' => "Tubs, Showers & Tiled Shower Areas", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 33, 'question_name' => "Dryer Operational", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 33, 'question_name' => "Dryer Vent", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 33, 'question_name' => "Washer Operational", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 33, 'question_name' => "Washer Leaks Detected", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 33, 'question_name' => "Washer Connection Visible", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 33, 'question_name' => "Visibility Behind Laundry Equipment", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 34, 'question_name' => "Visibility", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 34, 'question_name' => "Man-door Auto-Closer", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 34, 'question_name' => "Gas Tight from Living Space", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 34, 'question_name' => "Wear and Tear to Interior Finishes", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 34, 'question_name' => "Garage Slab", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 34, 'question_name' => "Garage Heated", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 35, 'question_name' => "Indication of Rodent Activity:", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 36, 'question_name' => "Smoke / CO Alarms Present", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 36, 'question_name' => "Strata Fire Extinguishers Present", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 36, 'question_name' => "Extinguisher Renewal Date", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => null, 'sub_cat_id' => 36, 'question_name' => "Fire Suppression\/Sprinklers Present", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 11, 'sub_cat_id' => null, 'question_name' => "This home compared to other homes of similar age and style", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_id' => 11, 'sub_cat_id' => null, 'question_name' => "We observed functional", 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}
