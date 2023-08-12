<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@deb.local',
            // 'password'=> 'secret123'
        ]);
        $bloodGroupData = [
            ['id' => 1, 'name' => 'A+'],
            ['id' => 2, 'name' => 'B+'],
            ['id' => 3, 'name' => 'AB+'],
            ['id' => 4, 'name' => 'O+'],
            ['id' => 5, 'name' => 'A-'],
            ['id' => 6, 'name' => 'B-'],
            ['id' => 7, 'name' => 'AB-'],
            ['id' => 8, 'name' => 'O-'],
        ];

        // Insert the Blood Group Data
        DB::table('blood_groups')->insert($bloodGroupData);

        $bloodDonationTypes = [
            ['id' => 1, 'name' => 'Whole Blood'],
            ['id' => 2, 'name' => 'RBC'],
            ['id' => 3, 'name' => 'Plasma'],
            ['id' => 4, 'name' => 'C'],
            ['id' => 5, 'name' => 'Cryo precipitate'],
            ['id' => 6, 'name' => 'F.F.P'],
            ['id' => 7, 'name' => 'Washed R.B.C'],
            ['id' => 8, 'name' => 'Others'],
        ];

        // Insert the Blood Donation Group Data
        DB::table('donation_types')->insert($bloodGroupData);
        // \App\Models\User::factory(10)->create();


    }
}
