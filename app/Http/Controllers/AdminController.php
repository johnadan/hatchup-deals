<?php

namespace App\Http\Controllers;

use App\Models\{User, Business, FeaturedBusiness};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function customers()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function businesses()
    {
        // $businesses = User::where('role', 'business')->get();
        $businesses = Business::all();
        return view('admin/businesses-index', compact('businesses'));
    }

    // Show pending business accounts
    public function pendingBusinesses()
    { //with('business')->
        $businesses = User::where('role', 'business')->where('status', 'pending')->get();
        // return view('admin.businesses.pending', compact('businesses'));
        return view('admin/businesses-pending', compact('businesses'));
    }

    // public function approveBusiness($id)
    // {
    //     $business = User::findOrFail($id);
    //     $business->status = 'approved';
    //     $business->save();

    //     // Send approval email to the business
    //     // Implement this using Laravel Mail

    //     // return redirect()->route('admin.businesses.pending')->with('success', 'Business account approved!');
    //     return redirect()->back()->with('success', 'Business account approved!');
    // }
    public function approve(User $business)
    {
        try {
            $business->update(['status' => 'approved']);
            return back()->with('success', 'Business user approved successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error approving business user');
        }
    }

    // public function rejectBusiness($id)
    // {
    //     $business = User::findOrFail($id);
    //     $business->status = 'rejected';
    //     $business->save();

    //     // Send rejection email to the business
    //     // Implement this using Laravel Mail

    //     // return redirect()->route('admin.businesses.pending')->with('success', 'Business account rejected!');
    //     return redirect()->back()->with('success', 'Business account rejected!');
    // }

    public function reject(User $business)
    {
        try {
            $business->update(['status' => 'rejected']);
            return back()->with('success', 'Business rejected successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error rejecting business');
        }
    }

    // Feature a business
    public function featureBusiness($id)
    {
        $business = User::findOrFail($id);
        FeaturedBusiness::create([
            'business_id' => $business->id,
            'featured_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Business featured!');
    }

    // Unfeature a business
    public function unfeatureBusiness($id)
    {
        FeaturedBusiness::where('business_id', $id)->delete();
        return redirect()->back()->with('success', 'Business unfeatured!');
    }
}
