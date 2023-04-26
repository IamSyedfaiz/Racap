<?php

namespace Database\Seeders;

use App\Http\Helpers\Permissions;
use App\Models\User;
use Illuminate\Database\Seeder;

use App\Http\Helpers\Roles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Super Admin
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('12345678')
        ]);
        $super_admin->assignRole(Roles::SUPER_ADMIN()->getValue());


        // Sub Admin
        $sub_admin = User::create([
            'name' => 'Sub Admin',
            'email' => 'subadmin@admin.com',
            'password' => bcrypt('12345678'),
            'parent_id' => $super_admin->id
        ]);
        $sub_admin->assignRole(Roles::SUB_ADMIN()->getValue());

        // // CLIENT under sub Admin
        // $co1_user = User::create([
        //     'name' => 'CLIENT 1',
        //     'email' => 'client@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'parent_id' => $sub_admin->id
        // ]);
        // $co1_user->assignRole(Roles::CLIENT()->getValue());

        // // consultant
        // $co2_user = User::create([
        //     'name' => 'consultant',
        //     'email' => 'consultant@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'parent_id' => $sub_admin->id
        // ]);
        // $co2_user->assignRole(Roles::CONSULTANT()->getValue());
    }
}
