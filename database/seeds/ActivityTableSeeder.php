<?php

use App\Helpers\Helper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::ADD,
            'table' => Helper::USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::ADD,
            'table' => Helper::RESTAURANT_USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::ADD,
            'table' => Helper::RESTAURANT_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::ADD,
            'table' => Helper::GROUP_USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::ADD,
            'table' => Helper::GROUP_MEMBER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::ADD,
            'table' => Helper::GROUP_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::ADD,
            'table' => Helper::GENERATE_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::UPDATE,
            'table' => Helper::USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::UPDATE,
            'table' => Helper::RESTAURANT_USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::UPDATE,
            'table' => Helper::RESTAURANT_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::UPDATE,
            'table' => Helper::GROUP_USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::UPDATE,
            'table' => Helper::GROUP_MEMBER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::UPDATE,
            'table' => Helper::GROUP_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::UPDATE,
            'table' => Helper::GENERATE_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::REMOVE,
            'table' => Helper::USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::REMOVE,
            'table' => Helper::RESTAURANT_USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::REMOVE,
            'table' => Helper::RESTAURANT_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::REMOVE,
            'table' => Helper::GROUP_USER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::REMOVE,
            'table' => Helper::GROUP_MEMBER_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::REMOVE,
            'table' => Helper::GROUP_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::REMOVE,
            'table' => Helper::GENERATE_TABLE,
        ]);
        DB::table('activity')->insert([
            'id' => Helper::generateId(32),
            'name' => Helper::GENERATE,
            'table' =>Helper::RESTAURANT_TABLE,
        ]);
    }
}
