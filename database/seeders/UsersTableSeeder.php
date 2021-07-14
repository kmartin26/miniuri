<?php

namespace Database\Seeders;

use App\Mail\AdminUser;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('app.contact')) {
            $password = Str::random(15);

            $admin = array(
                'username'  => 'admin',
                'password'  => $password,
                'email'     => config('app.contact')
            );

            User::firstOrCreate(
                ['email' => config('app.contact')], [
                    'name'      => 'admin',
                    'password'  => bcrypt($password),
                ]
            );

            Mail::to(config('app.contact'))->send(new AdminUser($admin));
        }
    }
}
