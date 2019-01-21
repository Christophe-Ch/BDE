<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'nom' => "ADMIN",
            "prenom" => "ADMIN",
            "adresse_mail" => "Admin@bde.fr",
            "mdp" => "ADMIN",
            "photo" => 'photo.png',
            "centre_id" => "1",
            "statut_id" => "1"
        ]);
    }
}
