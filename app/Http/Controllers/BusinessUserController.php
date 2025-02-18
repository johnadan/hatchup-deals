<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddBusinessUserRequest;
use App\Models\{User, Business};
use Illuminate\Support\Facades\Hash;

class BusinessUserController extends Controller
{
    public function create()
    {
        return view('business.users.create');
    }

    public function store(AddBusinessUserRequest $request)
    {
        $business = auth()->user()->business;

        $user = User::create([
            'display_name' => $request->display_name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'business', // Business user
            'business_id' => $business->id,
            'status' => 'approved', // Automatically approve business users
        ]);

        return redirect()->route('business.users.index')->with('success', 'User added successfully!');
    }

    public function index()
    {
        $business = auth()->user()->business;
        $users = $business->users;
        return view('business.users.index', compact('users'));
    }
}
