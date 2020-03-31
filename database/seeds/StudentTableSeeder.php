<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Student::class, 10)->create()->each(function ($student) {
            // Seed the relation with 5 payments
            $payments = factory(\App\Fee::class, 2)->make();
            $student->fees()->saveMany($payments);
        });
    }
}
