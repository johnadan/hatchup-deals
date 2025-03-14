<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Deal, DealCode, Category, Business, City, User, Order};

class CustomerController extends Controller
{
    // Show deals by category
    public function index(Category $category)
    {
        $deals = $category->deals->where('is_active', '1');
        // $deals = Deal::where('category_id', $category->id)->where('is_active', '1')->get();

        return view('deals/index', compact('category', 'deals'));
    }

    public function show(Deal $deal)
    {
        return view('deals.show', compact('deal'));
    }
    // public function businesses()
    // {
    //     // $categories = Category::all();
    //     // $cities = City::all();
    //     $businesses = Business::all();
    //     return view('customer/businesses', compact('businesses'));
    // }

    // public function businessCategory()
    // { //$categoryId
    //     // $category = Category::find($categoryId);
    //     // $businesses = Business::where('category_id', $categoryId)->get();
    //     // return view('customer/business-category', compact('category', 'businesses'));
    //     return view('customer/businesses-category');
    // }

    public function business($id)
    {
        $business = Business::find($id);
        return view('customer/business', compact('business'));
    }

    public function businessDeals($id)
    {
        $business = Business::find($id);
        $deals = Deal::where('business_id', $id)->get();
        return view('customer/business-details', compact('business', 'deals'));
    }

    // public function deals()
    // {
    //     $deals = Deal::where('is_active', 1)->get();
    //     return view('customer/deals', compact('deals'));
    //     // return view('customer/deals');
    // }

    // public function dealCategory()
    // { //$categoryId
    //     // $category = Category::find($categoryId);
    //     // $deals = Deal::where('category_id', $categoryId)->get();
    //     // return view('customer/deals-category', compact('category', 'deals'));
    //     return view('customer/deals-category');
    // }

    // public function dealDetails($id)
    // {
    //     $deal = Deal::find($id);
    //     $dealCodes = DealCode::where('deal_id', $id)->get();
    //     // return view('customer/deal-details', compact('deal', 'dealCodes'));
    //     return view('customer/deal');
    // }
}
