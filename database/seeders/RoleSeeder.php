<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Helpers\Roles;
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
        foreach (Roles::toArray() as $role) {
            Role::create(['name' => $role]);
        }
    }
}
