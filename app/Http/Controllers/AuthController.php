<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
// use App\Models\User;
// use App\Models\Business;
// use App\Models\Category;
use App\Models\{User, Business, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        // return view('auth.register');
        $categories = Category::all();
        // return view('auth.register', compact('categories'));
        return view('custom-auth/register', compact('categories'));
    }

    // Handle registration
    public function register(RegisterRequest $request)
    {
        if($request->role === 'business'){
            $business = Business::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->buss_phone_number,
                'category_id' => $request->category_id,
                'is_featured' => false,
                // 'city_id' => $request->city_id,
            ]);
        }

        $user = User::create([
            'display_name' => $request->display_name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => $request->role, // customer or business
            'status' => $request->role === 'business' ? 'pending' : 'approved', // Business accounts require approval
            'business_id' => $request->role === 'business' ? $business->id : null, // Only required for business accounts
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role' => $request->role, // customer or business
        //     'status' => $request->role === 'business' ? 'pending' : 'approved', // Business accounts require approval
        // ]);

        // If the user is a business owner, create a business and link the user to it
        // if ($request->role === 'business') {
        //     $business = Business::create([
        //         'name' => $request->business_name,
        //         'address' => $request->address,
        //         'category' => $request->category,
        //     ]);

        //     $user->business_id = $business->id;
        //     $user->save();
        // }

        // return redirect()->route('login')->with('success', 'Registration successful!');

        // Log in the user if their account is approved
        // if ($user->status === 'approved') {
        //     Auth::login($user);
        //     // return redirect()->route('home')->with('success', 'Registration successful!');
        //     // return redirect()->route('dashboard')->with('success', 'Registration successful!');
        //     return redirect()->route('deals')->with('success', 'Registration successful!');
        // }

        // Redirect based on role

        if ($user->role === 'business'){
            // Business accounts require approval
            return redirect()->route('login')->with('success', 'Your account is pending approval.');
        } else {
            // Log in the user
            Auth::login($user);

            if ($user->role === 'customer') {
                // return redirect()->route('customer.dashboard')->with('success', 'Registration successful!');
                return redirect()->route('customer.businesses.index')->with('success', 'Registration successful!');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.businesses.index')->with('success', 'Registration successful!');
            }
        }

    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user's account is approved
            if ($user->status !== 'approved') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is pending approval.');
            } else { //approved
                if ($user->role === 'customer') {
                    return redirect()->route('customer.businesses.index');
                    // ->with('success', 'Login successful!')
                } elseif ($user->role === 'admin') {
                    // return redirect()->route('admin.businesses.index');
                    return redirect()->route('admin.businesses.pending');
                    // ->with('success', 'Login successful!')
                } elseif ($user->status === 'approved' && $user->role === 'business') {
                    return redirect()->route('business.deals.index');
                }
            }

        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
