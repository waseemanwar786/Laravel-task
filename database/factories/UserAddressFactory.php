<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Generate a User instance for each address
            'address' => $this->faker->address,
        ];
    }
}
