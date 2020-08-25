<?php

use Illuminate\Database\Seeder;
use App\Entry;
use App\User;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Se obtienen los usuario :)
    	$users =User::all();
    	$users->each( function ($user){
    		//Creacion de registros  de fabrica con Faker :)
        	factory(Entry::class, 10)->create([
        		'user_id' => $user->id
        	]);
    	});

    }
}
