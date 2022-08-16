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
                'name' => 'Yazid Asykurillah',
                'email' => 'yazid@bitmaker-automation.com',
            ],
            [
                'name' => 'Yazid Asykurillah',
                'email' => 'yazid@bitmaker-automation.com',
                'password' => bcrypt('12345678'),
                'code'=>'001'
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
                'code'=>'002'
            ]
        );
        $admin->assignRole('Admin');
    }
}
