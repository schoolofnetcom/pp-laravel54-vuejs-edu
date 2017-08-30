<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(ClassInformationsTableSeeder::class);
        $this->call(ClassTestsTableSeeder::class);
        $this->call(StudentClassTestTableSeeder::class);
    }
}
