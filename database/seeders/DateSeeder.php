<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=DateSeeder
     */
    public function run(): void
    {
        $startYear = 1990;
        $endYear = 2040;

        // Loop through years, months, and days
        for ($year = $startYear; $year <= $endYear; $year++) {
            for ($month = 1; $month <= 12; $month++) {
                // Get the number of days in the current month
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                
                
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    // Insert the date into the database
                    DB::table('dates')->insert([
                        'date' => $date,
                        'year' => $year,
                        'month' => $month,
                        'day' => $day,
                    ]);
                }
            }
        }
    }
}
