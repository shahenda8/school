<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateMAnagerseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manager::create(
            [
                        'email'       => 'admin@admin.com',
                        'national_id' => '12345678901234',
                        'name'        => 'admin',
                        'phone'       => '0123456789',
                        'password'    => Hash::make('admin'), // لازم تستخدم hash
                        'user_name'   => 'admin',
                        'address'     => '123 Test Street, Cairo'
            ]
        );
    }
}
