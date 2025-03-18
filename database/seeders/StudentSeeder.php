<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
              'name'    => 'Mutiara',
                'email'   => 'mutiara12@gmail.com',
                'phone'   => '082133445566',
                'class'   => 'siswa v',
                'address' => 'Rajabassa',
                'gender'  => 'P',
                'status'  => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        
    }
}
