<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            [
                //admin
                'name'=>'Admin',
                'UserName'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('1234'),
                'NationalID'=>'343434',
                'Phone'=>'074537373',
                'role'=>'admin',
                'status'=>'active',
            ],
        [
            'name'=>'User',
            'UserName'=>'user',
            'email'=>'user@gmail.com',
            'password'=>Hash::make('1234'),
            'NationalID'=>'343434',
            'role'=>'user',
            'Phone'=>'074537373',
            'status'=>'active',
        ],
        [
            'name'=>'CareTaker',
            'UserName'=>'CareTaker',
            'email'=>'caretaker@gmail.com',
            'Phone'=>'074537373',
            'password'=>Hash::make('1234'),
            'NationalID'=>'343434',
            'role'=>'CareTaker',
            'status'=>'active',
        ],
    ]);
 }
 }

