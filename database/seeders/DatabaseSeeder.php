<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        //Generos
        $genderM = Gender::firstOrCreate(['name' => 'Masculino']);
        $genderF = Gender::firstOrCreate(['name' => 'Femenino']);
        $genderI = Gender::firstOrCreate(['name' => 'Indefinido']);
        $genderO = Gender::firstOrCreate(['name' => 'Otro']);

        $admin = User::create([
            'name' => "Admin",
            'last_name' => "Admin",
            'phone' => "123456789",
            'email' => "Admin@admin.com",
            'birthdate' => '1990-01-01',
            'email_verified_at' => '2021-01-01',
            'password' => Hash::make('123456789'),
        ]);
        $admin->assignRole($adminRole);

        $this->call(Values::class);
    }
}
