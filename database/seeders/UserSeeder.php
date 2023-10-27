<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nom' => 'John Doe',
            'prenom' => 'john@example.com',
            'som' => '321',
            'cin' => 'EE23113',
            'email' => 'admin@gmail.com',
            'admin' => 1,
            'grade' => 'A',
            'password' => hash::make('password')
        ]);
    }
}
