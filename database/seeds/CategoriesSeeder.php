<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => '计算机科学、资讯与总类', 'code' => '000','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '哲学与心理学', 'code' => '100','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '宗教', 'code' => '200','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '社会科学', 'code' => '300','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '语文', 'code' => '400','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '自然科学', 'code' => '500','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '应用科学', 'code' => '600','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '艺术', 'code' => '700','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '文学', 'code' => '800','created_at'=>date('Y-m-d')]);
        DB::table('categories')->insert(['name' => '历史与地理', 'code' => '900','created_at'=>date('Y-m-d')]);
    }
}
