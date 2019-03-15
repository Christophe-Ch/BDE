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
            'name' => "ADMIN",
            "prenom" => "ADMIN",
            "email" => "Admin@bde.fr",
            "password" => "$2y$10$7fhO/cPdBUnGEiGpRnNiEenUB4SNVTsZAQxzOJjSc/Q6IZEUnnWQG",
            "photo" => "default-avatar.png",
            "centre_id" => "1",
            "statut_id" => "2",
            "api_token" => str_random(100)
        ]);
    }
}
