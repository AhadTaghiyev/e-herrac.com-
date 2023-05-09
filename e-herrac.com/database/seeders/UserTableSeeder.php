<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'emin';
        $user->email = 'emin.rahmanov.1990@gmail.com';
        $user->first_name = 'Emin';
        $user->last_name = 'Rahmanov';
        $user->is_active = true;
        $user->password = bcrypt('090990');
        $user->save();
        $roles = Role::where('name', 'Super Admin')->pluck('id', 'id')->all();
        $user->assignRole($roles);

    }
}
