<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserAddress;
use App\Models\User;

class UserAddressesTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            UserAddress::factory(rand(1, 5))->create(['user_id' => $user->id]); // Each user gets 1-5 addresses
        }
    }
}

