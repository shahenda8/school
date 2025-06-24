<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('stages')->insert([
        [
                'name'         => 'grade 1',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 2',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 3',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 4',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 5',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 6',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 7',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 8',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 9',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 10',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 11',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        [
                'name'         => 'grade 12',
                'no_classes'   => 0,
                'no_students'  => 0,
                'no_teachers'  => 0,
                'no_subjects'  => 0
                ],
        ]);
    }
}
