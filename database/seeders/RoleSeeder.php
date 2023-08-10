<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id'   => 1, 'name'    => 'User'],
            ['id'   => 2, 'name'    => 'Administrator']
        ];

        foreach($roles as $role){
            Roles::create($role);
        }
    }
}
