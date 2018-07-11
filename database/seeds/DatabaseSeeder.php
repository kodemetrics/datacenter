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
         $this->call(UsersTableSeeder::class);
    }

}

class UsersTableSeeder extends Seeder {
    
          public function run(){

            DB::table('users')->insert([
                'name' => str_random(10),
                'role_id' => 1,
                'department' => "AEDC INFRASTRUCTURE AND PLATFORMS ",
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
            ]);
     
          }
   }