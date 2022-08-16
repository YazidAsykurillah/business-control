<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'code' => 'DEMO-SUP-ADM',
            ]
        );
        
        Role::updateOrCreate(
            [
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'code'=>'DEMO-ADM',
            ]
        );

        Role::updateOrCreate(
            [
                'name' => 'Writer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Writer',
                'guard_name' => 'web',
                'code'=>'DEMO-WRT',
            ]
        );
    }
}
