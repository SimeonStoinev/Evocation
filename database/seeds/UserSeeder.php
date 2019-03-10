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
     * Inserts a hard-coded headmaster user record and updates the school record with headmaster's id.
     * Inserts 3 hard-coded subheadmaster user records.
     * Depending on the iteration, decides whether it should go for the hard-coded records or the ones factory is generating.
     *
     * @param $schoolID
     * @return void
     */
    protected function createHeadmasterAndSubheadmasters ($schoolID) {
        if ($schoolID == 1) {
            $headmasterData = User::create([
                'name' => 'Headmaster',
                'family' => 'Headmaster',
                'email' => 'headmaster@gmail.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'rank' => 'headmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);

            School::find($schoolID)->update(['headmaster_id' => $headmasterData->id]);

            // Inserts a hard-coded subheadmaster 1
            User::create([
                'name' => 'Subheadmaster1',
                'family' => 'SubheadmasterF',
                'email' => 'subheadmaster1@gmail.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'rank' => 'subheadmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);

            // Inserts a hard-coded subheadmaster 2
            User::create([
                'name' => 'Subheadmaster2',
                'family' => 'SubheadmasterF',
                'email' => 'subheadmaster2@gmail.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'rank' => 'subheadmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);

            // Inserts a hard-coded subheadmaster 3
            User::create([
                'name' => 'Subheadmaster3',
                'family' => 'SubheadmasterF',
                'email' => 'subheadmaster3@gmail.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'rank' => 'subheadmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);
        } else {
            $headmasterData = factory(App\User::class)->create([
                'rank' => 'headmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);

            School::find($schoolID)->update(['headmaster_id' => $headmasterData->id]);

            factory(App\User::class)->create([
                'rank' => 'subheadmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);

            factory(App\User::class)->create([
                'rank' => 'subheadmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);

            factory(App\User::class)->create([
                'rank' => 'subheadmaster',
                'school_id' => $schoolID,
                'verified' => 1
            ]);
        }
    }

    /**
     * Truncates all tables that have something to do with this file.
     * Creates a hardcoded Admin record in Users table.
     * Creates a school record and updates all of it's fields in the end of the function.
     * Calls protected function createHeadmasterAndSubheadmasters
     * Creates grades and fills them with students, parents and a classteacher.
     * Creates legit curricula and matches them to the grades.
     * Updates the grades with a curriculum, school ID and JSON students.
     *
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // Inserts a hard-coded admin user --RUN THIS FOR FIRST SEED!
        User::create([
            'card_id' => str_random(16),
            'name' => 'Admin',
            'family' => '',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'rank' => 'admin',
            'verified' => 1,
            'remember_token' => str_random(10)
        ]);

        $schoolID = factory(App\School::class)->create([
            'title' => 'II СУ "Проф. Никола Маринов"'
        ])->id;

        // RUN THIS FOR MORE THAN ONE SEEDS AND COMMENT ABOVE!
        //$schoolID = factory(App\School::class)->create()->id;

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
            '6Б',
            '6В',
            '7А',
            '7Б',
            '8А',
            '8Б',
            '8В',
            '9А',
            '9Б',
            '9В',
            '10А',
            '10Б',
            '10В',
            '11А',
            '11Б',
            '11В',
            '12А',
            '12Б'
        ];

        for ($i = 0; $i < count($gradeTitlesArray); $i++) {
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
            if ($i < (count($gradeTitlesArray) / 2)) {
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

        // RUN THIS FOR FIRST SEED! COMMENT FOR MORE THAN ONE SEEDS
        $this->customTestRecords($schoolID);

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
     * Creates a custom grade and users for testing with actual names.
     *
     * @param $schoolID
     * @return void
     */
    protected function customTestRecords ($schoolID) {
        $gradeID = factory(Grade::class)->create([
            'title' => '12В'
        ])->id;

        // Creates a classteacher and matches it with the grade ID
        $classteacherID = factory(\App\User::class)->create([
            'name' => 'Денислав',
            'family' => 'Колев',
            'email' => 'noit2019@example.com',
            'rank' => 'teacher',
            'is_classteacher' => 1,
            'grade_id' => $gradeID,
            'school_id' => $schoolID,
            'verified' => 1
        ])->id;

         $studentIDsArray = [];
         $studentsInfo = [
             str_random(6) . ' Андрея Янчева noit2019v8@example.com Ивана Ивана noit2019v9example.com',
             str_random(6) . ' Велислава Велкова noit2019v10@example.com Ивана Ивана noit2019v11example.com',
             str_random(6) . ' Владислава Аврамова noit2019v12@example.com Ивана Ивана noit2019v13example.com',
             str_random(6) . ' Даниела Петрова noit2019v14@example.com Ивана Ивана noit2019v15example.com',
             '372cef Денислав Колев noit2019v16@example.com Ивана Ивана noit2019v17example.com',
             str_random(6) . ' Десислава Георгиева noit2019v18@example.com Ивана Ивана noit2019v19example.com',
             str_random(6) . ' Джанай Юмеров noit2019v20@example.com Ивана Ивана noit2019v21example.com',
             str_random(6) . ' Диляра Гюнай noit2019v22@example.com Ивана Ивана noit2019v23example.com',
             str_random(6) . ' Димо Русев noit2019v24@example.com Ивана Ивана noit2019v25example.com',
             str_random(6) . ' Ивелина Георгиева noit2019v26@example.com Ивана Ивана noit2019v27example.com',
             str_random(6) . ' Лина Димитрова noit2019v28@example.com Ивана Ивана noit2019v29example.com',
             str_random(6) . ' Любослав Лилов noit2019v30@example.com Ивана Ивана noit2019v31example.com',
             str_random(6) . ' Кристиян Грудев noit2019v32@example.com Ивана Ивана noit2019v33example.com',
             str_random(6) . ' Мария Кирилова noit2019v34@example.com Ивана Ивана noit2019v35example.com',
             str_random(6) . ' Михаел Веселинов noit2019v36@example.com Ивана Ивана noit2019v37example.com',
             str_random(6) . ' Мустафа Мустафов noit2019v38@example.com Ивана Ивана noit2019v39example.com',
             str_random(6) . ' Недялка Стойчкова noit2019v40@example.com Ивана Ивана noit2019v41example.com',
             str_random(6) . ' Петя Аделинова noit2019v42@example.com Ивана Ивана noit2019v43example.com',
             str_random(6) . ' Пламена Георгиева noit2019v44@example.com Ивана Ивана noit2019v45example.com',
             str_random(6) . ' Пламена Денева noit2019v46@example.com Ивана Ивана noit2019v47example.com',
             str_random(6) . ' Пресиан Петров noit2019v48@example.com Ивана Ивана noit2019v49example.com',
             str_random(6) . ' Радостин Нецов noit2019v50@example.com Ивана Ивана noit2019v51example.com',
             str_random(6) . ' Радостина Бонева noit2019v52@example.com Ивана Ивана noit2019v53example.com',
             str_random(6) . ' Ралица Русева noit2019v54@example.com Ивана Ивана noit2019v55example.com',
             '6e3c45 Симеон Стойнев noit2019v2@example.com Росица Стойнева noit2019v4@example.com',
             str_random(6) . ' Станислав Кирилов noit2019v58@example.com Ивана Ивана noit2019v59example.com',
             str_random(6) . ' Стефан Стефанов noit2019v60@example.com Ивана Ивана noit2019v61example.com',
             str_random(6) . ' Цветина Манова noit2019v62@example.com Ивана Ивана noit2019v63example.com'
         ];

        foreach ($studentsInfo as $student) {
            $tmp = explode(' ', $student);

            // Students of the class
            $studentID = factory(\App\User::class)->create([
                'card_id' => $tmp[0],
                'name' => $tmp[1],
                'family' => $tmp[2],
                'email' => $tmp[3],
                'rank' => 'student',
                'grade_id' => $gradeID,
                'school_id' => $schoolID,
                'verified' => 1
            ])->id;

            $studentIDsArray[] = $studentID;

            // Students' parents of the class
            $parentID = factory(\App\User::class)->create([
                'name' => $tmp[4],
                'family' => $tmp[5],
                'email' => $tmp[6],
                'rank' => 'parent',
                'school_id' => $schoolID,
                'family_link_id' => $studentID,
                'verified' => 1
            ])->id;

            User::find($studentID)->update(['family_link_id' => $parentID]);
        }

        $subjects = [
            'Български език и литература',
            'Математика',
            'Английски език',
            'Немски език',
            'Руски език',
            'Физика',
            'Физическо възпитание и спорт',
            'Свят и личност',
            'География',
            'История и цивилизация',
            'Информационни технологии',
            'Информатика',
            'Час на класа'
        ];

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
                $lesson->teacher_id = $classteacherID;
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

        Grade::find($gradeID)->update([
            'student_ids' => json_encode($studentIDsArray),
            'classteacher_id' => $classteacherID,
            'school_id' => $schoolID,
            'curriculum_id' => $curriculumID,
            'shift' => $shift
        ]);
    }
}