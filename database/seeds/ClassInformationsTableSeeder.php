<?php

use Illuminate\Database\Seeder;

class ClassInformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = \SON\Models\Student::all();
        $teachers = \SON\Models\Teacher::all();
        $subjects = \SON\Models\Subject::all();
        factory(\SON\Models\ClassInformation::class,50)
            ->create()
            ->each(function(\SON\Models\ClassInformation $model) use($students,$teachers,$subjects){
                /** @var \Illuminate\Support\Collection $studentsCol */
                $studentsCol = $students->random(10);
                $model->students()->attach($studentsCol->pluck('id'));

                $teaching = rand(3,9);

                $teachersCol = $teachers->random($teaching);
                $subjectsCol = $subjects->random($teaching);
                foreach (range(1,$teaching) as $value){
                    $model->teachings()->create([
                        'subject_id' => $subjectsCol->get($value-1)->id,
                        'teacher_id' => $teachersCol->get($value-1)->id,
                    ]);
                }
            });
    }
}
