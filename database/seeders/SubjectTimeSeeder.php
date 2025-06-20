<?php

namespace Database\Seeders;

use App\Models\SubjectTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectTimeSeeder extends Seeder
{
    /**
     * Run the database seeds:
     */
    public function run(): void
    {
        SubjectTime::insert([
            [
            'start_time'    => '07:00:00',
            'end_time'      => '08:30:00',
            'type'          => 'lec.1',
            ],
            [
            'start_time'    => '08:30:00',
            'end_time'      => '10:00:00',
            'type'          => 'lec.2',
            ],
            [
            'start_time'    => '10:00:00',
            'end_time'      => '11:30:00',
            'type'          => 'lec.3',
            ],
            [
            'start_time'    => '12:00:00',
            'end_time'      => '13:30:00',
            'type'          => 'lec.4',
            ],
            [
            'start_time'    => '13:30:00',
            'end_time'      => '15:00:00',
            'type'          => 'lec.5',
            ],
            [
            'start_time'    => '15:00:00',
            'end_time'      => '16:30:00',
            'type'          => 'lec.6',
            ],
            [
            'start_time'    => '16:30:00',
            'end_time'      => '18:00:00',
            'type'          => 'lec.7',
            ],
        ]

        );
    }
}
