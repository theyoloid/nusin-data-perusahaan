<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::connection('pgsql');
        DB::table('users')->insert(
        [
            'username'=>'david',
            'nama'=>'Admin David',
            'password'=>Hash::make('nusin123'),
        ]
        );
    }
}