<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $countries = [
            'Netherlands',
            'United States',
            'Canada',
            'Brazil',
            'Mexico',
            'Russia',
            'China',
            'India',
            'Indonesia',
            'Pakistan',
            'Bangladesh',
            'Japan',
            'Germany',
            'France',
            'United Kingdom',
            'Italy',
            'Turkey',
            'Iran',
            'South Korea',
            'Egypt',
            'Nigeria',
            'South Africa',
            'Argentina',
            'Australia',
            'Saudi Arabia'
        ];

        foreach ($countries as $country) {
            DB::table('countries')->insert(
                ['name' => $country]
            );
        }
    }
}
