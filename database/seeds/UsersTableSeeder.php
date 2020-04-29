<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::truncate();

        DB::table('role_user');

        $super_admin = User::create([
            'name' =>'superAdmin',
            'last_name' =>'aaaaaaa',
            'civility' =>'m',
            'phone' =>'0000000000',
            'email' =>'superadmin@admin.com',
            'password' =>Hash::make('123456789'),
        ]);
        $admin = User::create([
            'name' =>'admin',
            'last_name' =>'aaaaaaa',
            'civility' =>'m',
            'phone' =>'0000000000',
            'email' =>'admin@admin.com',
            'password' =>Hash::make('123456789'),
        ]);
        $guest = User::create([
            'name' =>'guest',
            'last_name' =>'aaaaaaa',
            'civility' =>'m',
            'phone' =>'0000000000',
            'email' =>'guest@guest.com',
            'password' =>Hash::make('123456789'),
        ]);

        $super_adminRole = Role::where('name', 'super-admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $guestRole = Role::where('name', 'guest')->first();

        $super_admin->roles()->attach($super_adminRole);
        $admin->roles()->attach($adminRole);
        $guest->roles()->attach($guestRole);
    }
}
