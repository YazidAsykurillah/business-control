<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::updateOrCreate(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@email.com',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@email.com',
                'password' => bcrypt('12345678'),
                'code'=>'000'
            ]
        );
        $superadmin->assignRole('Super Admin');

        $admin = User::updateOrCreate(
            [
                'name' => 'Admin',
                'email' => 'testadmin@bitmaker-automation.com',
            ],
            [
                'name' => 'Admin',
                'email' => 'testadmin@bitmaker-automation.com',
                'password' => bcrypt('12345678'),
                'code'=>'001'
            ]
        );
        $admin->assignRole('Admin');
    }
}
