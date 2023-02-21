<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $config= ['table'=>'users', 'length'=>11, 'prefix'=>'010'];
        $user_id = IdGenerator::generate($config);
        return [
            'id' => $user_id,
            'phonenumber' => random_int(4387438484, 9034783494),
            'district_id' => random_int(1, 17),
            'gender_id' => random_int(1,2),
            'role_as' => random_int(0,0),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        DB::table('business')->insert([
            'user_id' => $user_id,
            'business_name' => $this->faker->business,
            'category_id' => random_int(1,8),
            'business_type_id' => random_int(1,4),
            'tax_clearance' => Str::random(10).'png',
            'business_certificate' => Str::random(10).'png',
            'ppda' =>  Str::random(10).'png',
            'other_docs' => Str::random(10).'png'
        ]);
    }
}
