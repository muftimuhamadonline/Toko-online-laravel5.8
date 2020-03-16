<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call(CategoriesSeeder::class);
        $this->call(UsersTableSeeders::class);
        $this->call(CategoriesSeeder::class);   
        $this->call(ProductsSeeders::class);
    }
}
