<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleSeeder::class]);
        
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password'  => Hash::make('password'),
            'role_id' => Roles::getRoleAdministrator()
        ]);      
        
        \App\Models\User::factory()->create([
            'name' => 'User Test',
            'email' => 'user@user.com',
            'password'  => Hash::make('password'),
            'role_id' => Roles::getRoleUser()
        ]);      
    }
}
