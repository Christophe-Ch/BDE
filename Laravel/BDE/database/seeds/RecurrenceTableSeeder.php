<?php

use Illuminate\Database\Seeder;

class RecurrenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recurrences')->insert([
            "nom" => "Jamais"
        ]);

        DB::table('recurrences')->insert([
            "nom" => "Par jour"
        ]);

        DB::table('recurrences')->insert([
            "nom" => "Par semaine"
        ]);

        DB::table('recurrences')->insert([
            "nom" => "Par mois"
        ]);

        DB::table('recurrences')->insert([
            "nom" => "Par ans"
        ]);
    }
}
