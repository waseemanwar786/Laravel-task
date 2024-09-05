<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userOutput()
    {
        // Select all records from users and count their records in user_addresses
        $users = User::withCount('addresses')->get();

        // Select all records from users whose records do not exist in user_addresses
        $usersWithoutAddresses = User::doesntHave('addresses')->get();

        // Select all duplicate records in user_addresses and count their iteration
        $duplicateAddresses = UserAddress::select('address', DB::raw('COUNT(*) as address_count'))
            ->groupBy('address')
            ->having('address_count', '>', 1)
            ->get();
            
        return view('dashboard', compact('users', 'usersWithoutAddresses', 'duplicateAddresses'));
    }
}

