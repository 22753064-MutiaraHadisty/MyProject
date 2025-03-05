<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name'    => 'Mutiara',
                'email'   => 'mutiara12@gmail.com',
                'phone'   => '082133445566',
                'course'  => 'Matematika',
                'address' => 'Rajabassa',
                'gender'  => 'P',
                'status'  => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'    => 'Muti',
                'email'   => 'mutiara23@gmail.com',
                'phone'   => '082133447567',
                'course'  => 'Biologi',
                'address' => 'Sukarame',
                'gender'  => 'L',
                'status'  => 'Tidak Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Menggunakan foreach untuk insert data
        foreach ($teachers as $teacher) {
            DB::table('teacher')->insert($teacher);
        }
    }
}
