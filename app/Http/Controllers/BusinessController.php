<?php

namespace App\Http\Controllers;

// use App\Models\Business;
// use App\Models\Category;
use App\Models\{Business, Category, Deal, FeaturedDeal};
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\StoreDealRequest;
use App\Http\Requests\UpdateBusinessRequest;

class BusinessController extends Controller
{
    // Show businesses by category
    public function index(Category $category)
    {
        $businesses = $category->businesses;
        return view('businesses/index', compact('category', 'businesses'));
    }

    // Show individual business profile
    public function show(Business $business)
    {
        return view('businesses.show', compact('business'));
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $deals = Deal::where('business_id',  auth()->user()->business)->get();
    //     return view('business/deals/index', compact('deals'));
    //     // return view('business/deals/index');
    // }

    // public function categoryBusinesses(Category $category)
    // {
    //     // $businesses = $category->businesses;
    //     // return view('category-businesses', compact('businesses', 'category'));
    //     return view('category-businesses');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function createUser()
    {
        return view('auth.register-business');
    }

    public function createDeal()
    {
        $categories = Category::all();
        return view('business/deals/create', compact('categories'));
    }

    public function storeDeal(StoreDealRequest $request)
    {
        dd($request->all());
        // $business = auth()->user()->business;
        // $deal = $business->deals()->create([
        //     'image' => $request->file('image')->store('public/images/deals', 'public'),
        //     'category_id' => $business->category_id,
        //     ...$request->validated()
        // ]);
        // return redirect()->route('business.deals.index')->with('success', 'Deal created!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Business $business)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        //
    }

    // Feature a deal
    public function featureDeal($id)
    {
        $deal = Deal::findOrFail($id);
        FeaturedDeal::create([
            'deal_id' => $deal->id,
            'featured_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Deal featured!');
    }

    // Unfeature a deal
    public function unfeatureDeal($id)
    {
        FeaturedDeal::where('deal_id', $id)->delete();
        return redirect()->back()->with('success', 'Deal unfeatured!');
    }
}
