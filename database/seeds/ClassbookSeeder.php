<?php

use Illuminate\Database\Seeder;

class ClassbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Classbook::class, 20)->create();
    }
}
