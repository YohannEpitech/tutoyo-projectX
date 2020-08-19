<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'name' => 'Yohann1',
            'email' => '1@gmail.com',
            'role' => 2,
            'follow_tutos'=>'a:0:{}',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Yohann2',
            'email' => '2@gmail.com',
            'role' => 1,
            'follow_tutos'=>'a:0:{}',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Yohann3',
            'email' => '3@gmail.com',
            'role' => 0,
            'follow_tutos'=>'a:0:{}',
            'password' => Hash::make('password'),
        ]);
        DB::table('langages')->insert([
            'name' => 'Docker',
            'imgName' => 'docker.png',
        ]);
        DB::table('langages')->insert([
            'name' => 'C',
            'imgName' => 'C.png',
        ]);
        DB::table('langages')->insert([
            'name' => 'C++',
            'imgName' => 'C++.png',
        ]);
        DB::table('langages')->insert([
            'name' => 'Mysql',
            'imgName' => 'Mysql.png',
        ]);
        DB::table('langages')->insert([
            'name' => 'Python',
            'imgName' => 'Python.png',
        ]);
        DB::table('langages')->insert([
            'name' => 'Ruby',
            'imgName' => 'ruby.png',
        ]);
    }
}
