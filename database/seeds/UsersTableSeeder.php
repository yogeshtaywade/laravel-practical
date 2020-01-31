<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {            
            $user = new User;
            $user->first_name=Str::random(10);
            $user->last_name=Str::random(10);
            $user->email=Str::random(10).'@gmail.com';
            $user->phone=mt_rand(0000000000,9999999999);
            $user->image='https://picsum.photos/200';
            $user->password = bcrypt('user@111');
            $user->save();
            $user_role= Role::where('name','user')->first();
            $user->assignRole($user_role);
        }
    }
}
