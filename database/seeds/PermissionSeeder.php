<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_1 = Permission::updateOrCreate(
            ['name' => 'create-user'],
            ['name' => 'create-user']
        );
        $permission_1->syncRoles(['Admin']);

        $permission_2 = Permission::updateOrCreate(
            ['name' => 'manage-blog'],
            ['name' => 'manage-blog']
        );
        $permission_2->syncRoles(['Admin']);
        

    }
}
