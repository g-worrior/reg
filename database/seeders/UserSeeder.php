<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config= ['table'=>'users', 'length'=>11, 'prefix'=>'010'];
        $user_id = IdGenerator::generate($config);

        DB::table('users')->insert([
            'id' => $user_id,
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'phonenumber' => random_int(4387438484, 9034783494),
            'district_id' => random_int(1, 17),
            'gender_id' => random_int(1,2),
            'role_as' => random_int(0,0)
        ]);
        DB::table('business')->insert([
            'user_id' => $user_id,
            'business_name' => Str::random(10),
            'category_id' => random_int(1,8),
            'business_type_id' => random_int(1,4),
            'tax_clearance' => Str::random(10).'png',
            'business_certificate' => Str::random(10).'png',
            'ppda' =>  Str::random(10).'png',
            'other_docs' => Str::random(10).'png'
        ]);
    }
}
