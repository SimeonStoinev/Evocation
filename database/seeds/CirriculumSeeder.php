<?php

use Illuminate\Database\Seeder;

class CirriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Curriculum::class, 20)->create();
    }
}
