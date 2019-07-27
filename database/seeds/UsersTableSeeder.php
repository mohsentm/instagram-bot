<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Mohsen Hosseini',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'status' => 'ENABLE'
        ];

        if (!User::where(['email' => $user['email']])->exists()) {
            $this->command->info('Create new user. Email: ' . $user['email']);
            User::create($user);
        } else {
            $this->command->info('User Exists. Email: ' . $user['email']);
        }
    }
}
