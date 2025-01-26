<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super@app.com',
            'password' => bcrypt('123456789'),]);

        $users->attachRole('super_admin');
    }
}
