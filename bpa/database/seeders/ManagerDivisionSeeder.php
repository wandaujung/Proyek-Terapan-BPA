<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managerDivision = \App\Models\Division::firstOrCreate(['name' => 'Manager']);
        
        \App\Models\User::firstOrCreate(
            ['email' => 'manager@manager.com'],
            [
                'name' => 'Manager',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'division_id' => $managerDivision->id
            ]
        );
    }
}
