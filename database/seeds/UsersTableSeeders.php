<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert(
                [
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => bcrypt('secret'),
                    'level' => 'customer'
                ]
            );
        }
        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12341234'),
                'level' => 'admin'
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('12341234'),
                'level' => 'customer'
            ]
        );
    }
}
