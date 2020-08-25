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
    	//Creación de un usuairo inicial :)
        User::create([
        	'name' => 'Ryan',
        	'email' => 'ryan@gmail.com',
        	'password' => bcrypt('12345678')
        ]);

        //Creacion de usuarios de fabrica con Faker :)
        factory(User::class, 10)->create();
    }
}
