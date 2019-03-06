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
            //AbsenceSeeder::class,
            //ClassbookSeeder::class,
            //CurriculumSeeder::class,
            //EntrySeeder::class,
            //ExamSeeder::class,
            //GradeSeeder::class,
            //PollSeeder::class,
            //PresentationSeeder::class,
            //SchoolSeeder::class,
            SubjectSeeder::class,
            UserSeeder::class
        ]);
    }
}
