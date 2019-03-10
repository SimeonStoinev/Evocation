<?php

use Illuminate\Database\Seeder;
use App\User;
use App\School;
use App\Grade;
use App\Curriculum;
use App\Subject;
use App\Lesson;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        School::truncate();
        Grade::truncate();
        Curriculum::truncate();
        Subject::truncate();
        Lesson::truncate();

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
