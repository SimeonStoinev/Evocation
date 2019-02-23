<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\School;
use App\Grade;
use App\Curriculum;
use App\Subject;
use App\Lesson;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Truncates all tables that have something to do with this file.
     * Creates a hardcoded Admin record in Users table.
     * Creates a school record and updates all of it's fields in the end of the function.
     * Calls protected function createHeadmasterAndSubheadmasters
     * Creates grades and fills them with students, parents and a classteacher.
     * Creates legit curricula and matches them to the grades.
     * Updates the grades with a curriculum, school ID and JSON students.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        School::truncate();
        Grade::truncate();
        Curriculum::truncate();
        Lesson::truncate();

        // Inserts a hard-coded admin user
        User::create([
            'card_id' => str_random(16),
            'name' => 'Admin',
            'family' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'rank' => 'admin',
            'verified' => 1,
            'remember_token' => str_random(10)
        ]);

        $schoolID = factory(App\School::class)->create()->id;

        factory(\App\User::class, 30)->create([
            'rank' => 'teacher',
            'school_id' => $schoolID,
            'verified' => 1
        ]);

        $this->createHeadmasterAndSubheadmasters($schoolID);

        $gradeTitlesArray = [
            '1А',
            '1Б',
            '1В',
            '1Г',
            '2А',
            '2Б',
            '2В',
            '2Г',
            '3А',
            '3Б',
            '3В',
            '4А',
            '4Б',
            '5А',
            '5Б',
            '5В',
            '6А',
            '7А',
            '7Б',
            '8А',
            '8Б',
            '8В',
            '9А',
            '9Б',
            '10А',
            '10Б',
            '11А',
            '11Б',
            '11В',
            '12А',
            '12Б',
            '12В',
            '12Г'
        ];

        for ($i = 0; $i < 30; $i++) {
            $gradeID = factory(Grade::class)->create([
                'title' => $gradeTitlesArray[$i]
            ])->id;

            // Creates a classteacher and matches it with the grade ID
            $classteacherID = factory(\App\User::class)->create([
                'rank' => 'teacher',
                'is_classteacher' => 1,
                'grade_id' => $gradeID,
                'school_id' => $schoolID,
                'verified' => 1
            ])->id;

            $studentIDsArray = [];

            for ($c = 0; $c < 25; $c++) {
                // Students of the class
                $studentID = factory(\App\User::class)->create([
                    'rank' => 'student',
                    'grade_id' => $gradeID,
                    'school_id' => $schoolID,
                    'verified' => 1
                ])->id;

                $studentIDsArray[] = $studentID;

                // Students' parents of the class
                $parentID = factory(\App\User::class)->create([
                    'rank' => 'parent',
                    'school_id' => $schoolID,
                    'family_link_id' => $studentID,
                    'verified' => 1
                ])->id;

                User::find($studentID)->update(['family_link_id' => $parentID]);
            }

            // Gets all ids of the teachers in the school
            $teachersResult = DB::table('users')->orderBy('id')->where(['rank' => 'teacher', 'school_id' => $schoolID])->select('id')->get()->toArray();
            $teachers = [];
            foreach ($teachersResult as $row) {
                $teachers[] = $row->id;
            }

            // Gets all ids of the subjects
            $subjectsResult = Subject::where('title', '!=', '')->orderBy('id')->select('title')->get()->toArray();
            $subjects = [];
            foreach ($subjectsResult as $row) {
                $subjects[] = $row['title'];
            }

            // This if statement cuts the curricula in a half - being able to create 2 equally populated shifts
            if ($i < 15) {
                // 1st curriculum shift
                $timeRanges = [
                    '07:30 - 08:10',
                    '08:20 - 09:00',
                    '09:10 - 09:50',
                    '10:10 - 10:50',
                    '11:00 - 11:40',
                    '11:45 - 12:25',
                    '12:30 - 13:10'
                ];

                $shift = 1;
                $curriculumData = [];

                for ($dayCount = 1; $dayCount <= 7; $dayCount++) {
                    // Decides the day of the week based on the number in the foreach.
                    if($dayCount==1){$day='Mon';}elseif($dayCount==2){$day='Tue';}elseif($dayCount==3){$day='Wed';}elseif($dayCount==4){$day='Thu';}elseif($dayCount==5){$day='Fri';}elseif($dayCount==6){$day='Sat';}elseif($dayCount==7){$day='Sun';}

                    for ($c = 0; $c <= 6; $c++) {
                        $timeRange = explode(' - ', $timeRanges[$c]);

                        $lesson = new Lesson();
                        $lesson->title = array_random($subjects);
                        $lesson->grade_id = $gradeID;
                        $lesson->teacher_id = array_random($teachers);
                        $lesson->time_range_from = $timeRange[0];
                        $lesson->time_range_to = $timeRange[1];
                        $lesson->day = $day;
                        $lesson->save();

                        $curriculumData[$day][] = $lesson->id;
                    }
                }

                $curriculumID = factory(Curriculum::class)->create([
                    'grade_id' => $gradeID,
                    'lessons_data' => json_encode($curriculumData)
                ])->id;
            } else {
                // 2nd curriculum shift
                $timeRanges = [
                    '13:30 - 14:10',
                    '14:20 - 15:00',
                    '15:10 - 15:50',
                    '16:10 - 16:50',
                    '17:00 - 17:40',
                    '17:45 - 18:25',
                    '18:30 - 19:10'
                ];

                $shift = 2;
                $curriculumData = [];

                for ($dayCount = 1; $dayCount <= 7; $dayCount++) {
                    // Decides the day of the week based on the number in the foreach.
                    if($dayCount==1){$day='Mon';}elseif($dayCount==2){$day='Tue';}elseif($dayCount==3){$day='Wed';}elseif($dayCount==4){$day='Thu';}elseif($dayCount==5){$day='Fri';}elseif($dayCount==6){$day='Sat';}elseif($dayCount==7){$day='Sun';}

                    for ($c = 0; $c <= 6; $c++) {
                        $timeRange = explode(' - ', $timeRanges[$c]);

                        $lesson = new Lesson();
                        $lesson->title = array_random($subjects);
                        $lesson->grade_id = $gradeID;
                        $lesson->teacher_id = array_random($teachers);
                        $lesson->time_range_from = $timeRange[0];
                        $lesson->time_range_to = $timeRange[1];
                        $lesson->day = $day;
                        $lesson->save();

                        $curriculumData[$day][] = $lesson->id;
                    }
                }

                $curriculumID = factory(Curriculum::class)->create([
                    'grade_id' => $gradeID,
                    'lessons_data' => json_encode($curriculumData)
                ])->id;
            }

            Grade::find($gradeID)->update([
                'student_ids' => json_encode($studentIDsArray),
                'classteacher_id' => $classteacherID,
                'school_id' => $schoolID,
                'curriculum_id' => $curriculumID,
                'shift' => $shift
            ]);
        }

        // Updates the school's fields that got left with the default '0' value.
        $schoolStudentsCount = DB::table('users')->where(['school_id' => $schoolID, 'rank' => 'student'])->count();
        $schoolTeachersCount = DB::table('users')->where(['school_id' => $schoolID, 'rank' => 'teacher'])->count();
        $schoolGradesCount = DB::table('grades')->where('school_id', $schoolID)->count();

        School::find($schoolID)->update([
            'grades_number' => $schoolGradesCount,
            'students_number' => $schoolStudentsCount,
            'teachers_number' => $schoolTeachersCount
        ]);
    }

    /**
     * @param $schoolID
     *
     * Inserts a hard-coded headmaster user record and updates the school record with headmaster's id.
     * Inserts 3 hard-coded subheadmaster user records.
     *
     * @return void
     */
    protected function createHeadmasterAndSubheadmasters ($schoolID) {
        $headmasterData = User::create([
            'card_id' => str_random(16),
            'name' => 'Headmaster',
            'family' => 'Headmaster',
            'email' => 'headmaster@gmail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'rank' => 'headmaster',
            'school_id' => $schoolID,
            'verified' => 1,
            'remember_token' => str_random(10)
        ]);

        School::find($schoolID)->update(['headmaster_id' => $headmasterData->id]);

        // Inserts a hard-coded subheadmaster 1
        User::create([
            'card_id' => str_random(16),
            'name' => 'Subheadmaster1',
            'family' => 'SubheadmasterF',
            'email' => 'subheadmaster1@gmail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'rank' => 'subheadmaster',
            'school_id' => $schoolID,
            'verified' => 1,
            'remember_token' => str_random(10)
        ]);

        // Inserts a hard-coded subheadmaster 2
        User::create([
            'card_id' => str_random(16),
            'name' => 'Subheadmaster2',
            'family' => 'SubheadmasterF',
            'email' => 'subheadmaster2@gmail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'rank' => 'subheadmaster',
            'school_id' => $schoolID,
            'verified' => 1,
            'remember_token' => str_random(10)
        ]);

        // Inserts a hard-coded subheadmaster 3
        User::create([
            'card_id' => str_random(16),
            'name' => 'Subheadmaster3',
            'family' => 'SubheadmasterF',
            'email' => 'subheadmaster3@gmail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'rank' => 'subheadmaster',
            'school_id' => $schoolID,
            'verified' => 1,
            'remember_token' => str_random(10)
        ]);
    }
}