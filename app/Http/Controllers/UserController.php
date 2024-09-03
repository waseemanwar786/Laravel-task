<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    public function getUserAddressCounts()
    {
        $users = DB::table('users')
        ->leftJoin('user_addresses', 'users.id', '=', 'user_addresses.user_id')
        ->select('users.id', 'users.name', 'users.email', DB::raw('COUNT(user_addresses.id) as address_count'))
        ->groupBy('users.id', 'users.name', 'users.email')
        ->get();
    
    return view('dashboard', compact('users'));
    }


    public function getUsersWithoutAddresses()
{
    $usersWithoutAddresses = DB::table('users')
    ->leftJoin('user_addresses', 'users.id', '=', 'user_addresses.user_id')
    ->whereNull('user_addresses.user_id') // Check for null user_id in user_addresses
    ->select('users.*')
    ->get();

    return view('dashboard', compact('usersWithoutAddresses'));
}

    public function getDuplicateAddresses()
    {
        $duplicateAddresses = DB::table('user_addresses')
           ->select('address', DB::raw('COUNT(*) as count'))
           ->groupBy('address')
           ->havingRaw('COUNT(*) > 1') 
           ->get();
        return view('dashboard', compact('duplicateAddresses'));
    }
}
