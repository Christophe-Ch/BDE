<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CentreTableSeeder::class);
        $this->call(StatutTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(ArticleUserTableSeeder::class);
        $this->call(CommentaireTableSeeder::class);
        $this->call(ManifestationTableSeeder::class);
        $this->call(ManifestationUserTableSeeder::class);
        $this->call(PhotoUserTableSeeder::class);
        $this->call(PhotoTableSeeder::class);
        $this->call(IdeeTableSeeder::class);
        $this->call(IdeeUserTableSeeder::class);
        $this->call(NotificationTableSeeder::class);
        $this->call(RecurrenceTableSeeder::class);
        $this->call(CategorieTableSeeder::class);
    }
}
