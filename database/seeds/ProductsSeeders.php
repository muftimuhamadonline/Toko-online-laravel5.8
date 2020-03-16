<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeders extends Seeder
{
    public function run()
    {
        DB::table('products')->insert(
            [
                'name' => 'jam',
                'price' => '12000',
                'stock' => '12',
                'picture' => '1.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '1'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'lampu',
                'price' => '100000',
                'stock' => '12',
                'picture' => '2.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '2'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'lilin',
                'price' => '1500',
                'stock' => '12',
                'picture' => '3.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '3'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'payung',
                'price' => '50000',
                'stock' => '12',
                'picture' => '4.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '4'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'tongkat ajaib',
                'price' => '1500000',
                'stock' => '12',
                'picture' => '5.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '1'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'tongkat sakti',
                'price' => '120000',
                'stock' => '12',
                'picture' => '6.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '2'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'batu kapur',
                'price' => '100',
                'stock' => '12',
                'picture' => '7.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '3'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'sepatu koyak',
                'price' => '1200000',
                'stock' => '12',
                'picture' => '8.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '4'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'sepatu',
                'price' => '120000',
                'stock' => '12',
                'picture' => '9.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '1'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'sepatu hitam',
                'price' => '1200',
                'stock' => '12',
                'picture' => '10.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'categories_id' => '2'
            ]
        );
    }
}
