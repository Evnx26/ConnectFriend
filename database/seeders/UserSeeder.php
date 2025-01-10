<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i = 0; $i < 10; $i++){
            $user = User::create([
                'name' => $faker->name,
                'email'=> $faker->email, 
                'phone_number'=> $faker->phoneNumber,
                'gender' => $faker->randomElement(['male', 'female']),
                'linkedin'=> $faker->userName,
                'password' => bcrypt('password')
            ]);

            $works = Work::inRandomOrder()->take(3)->pluck('id');
            $user->works()->attach($works);
        }

        $riccardo = User::create([
            'name' => 'Riccardo',
            'email' => 'riccardodav26@gmail.com',
            'phone_number' => '081854654815', 
            'gender' => 'male', 
            'linkedin' => 'riccardo.davinci', 
            'password' => bcrypt('password')
        ]);

        $works = Work::inRandomOrder()->take(3)->pluck('id');
        $riccardo->works()->attach($works);
    }
}
