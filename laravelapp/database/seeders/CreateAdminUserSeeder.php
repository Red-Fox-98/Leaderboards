<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);

//        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

//        $role->syncPermissions($permissions);

        $user->assignRole([Role::find(1)->name]);
    }
}
