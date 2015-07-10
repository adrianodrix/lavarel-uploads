<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{	

	public function run()
	{
		\App\User::truncate();

		$user = new \App\User();
		$user->name = 'Adriano Santos';
		$user->email = 'adrianodrix@gmail.com';
		$user->password = bcrypt('123456');
		$user->save();

		$faker = \Faker\Factory::create();

		for ($i = 0; $i < 10; $i++){
			$user = \App\User::create(array(
				'name' => $faker->userName,
				'email' => $faker->email,
				'password' => bcrypt('123456')
			));
		}
	}
}
