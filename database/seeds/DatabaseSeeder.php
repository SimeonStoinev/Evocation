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
        $this->call([
            UserSeeder::class,
            ClassbookSeeder::class,
            CirriculumSeeder::class,
            SchoolSeeder::class,
            ExamSeeder::class,
            GradeSeeder::class,
            PollSeeder::class,
            PresentationSeeder::class
        ]);

    }
}
