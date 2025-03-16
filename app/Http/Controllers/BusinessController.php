<?php

namespace App\Http\Controllers;

use App\Models\{Business, Category, Deal, FeaturedDeal};
use App\Http\Requests\StoreDealRequest;
use App\Http\Requests\UpdateDealRequest;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use Illuminate\Support\Facades\Storage;

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
     * Display a listing of the deals created by the logged in business user.
     */
    public function businessDeals()
    {
        // $deals = Deal::where('business_id',  auth()->user()->business->id)->get();
        $deals = Deal::where('business_id', auth()->user()->business->id)
                ->paginate(10);
        return view('business/deals/index', compact('deals'));
        // return view('business/deals/index');
    }

    public function dealsbyBusiness(Business $business)
    {
        $deals = $business->deals->where('is_active', '1')->where('end_date', '>=', now());
        // ->paginate(9);
        return view('businesses.deals', compact('business', 'deals'));
    }

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

    public function editDeal(Deal $deal)
    {
        $categories = Category::all();

        return view('business/deals/edit', compact('deal', 'categories'));
    }

    public function storeDeal(StoreDealRequest $request)
    {
        try {
            $business = auth()->user()->business;

            // $allowedfileExtensions = ['jpeg','jpg','png'];
            // $image = $request->file('image');

            $imagePath = $request->file('image')->store('deals', 'public');

            // $imagePath = Storage::disk('public')->put('deals', $request->file('image'));

            $validated = $request->validated();

            unset($validated['image']);

            $deal = $business->deals()->create([
                'image' => $imagePath,
                'category_id' => $business->category_id,
                'business_id' => $business->id,
                'is_active' => $request->has('is_active'), // true if checked, false otherwise
                'is_featured' => $request->has('is_featured'), // true if checked, false otherwise
                ...$validated
            ]);

            // if (!$deal) {
            //     throw new \Exception('Failed to create the deal.');
            // }

            return redirect()->route('business.deals.index')->with('success', 'Deal created!');

            // // Begin database transaction
            // \DB::beginTransaction();

            // // Create a new deal using the validated data
            // $deal = Deal::create($request->validated());

            // // Create a new featured deal if required
            // if ($request->input('is_featured', false)) {
            //     FeaturedDeal::create([
            //         'deal_id' => $deal->id,
            //         'business_id' => $deal->business_id,
            //     ]);
            // }

            // // Commit the database transaction
            // \DB::commit();
        } catch (\Exception $e) {
            \Log::error('Error creating deal: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred while creating the deal. Please try again.');

        // // Rollback the database transaction
            // \DB::rollBack();
            // // Handle the exception here
        }
    }

    public function updateDeal(UpdateDealRequest $request, Deal $deal)
    {
        // Add authorization
        // $this->authorize('update', $deal);

        try {
            $validated = $request->validated();

            if ($request->hasFile('image')) {
                if ($deal->image) {
                    Storage::disk('public')->delete($deal->image);
                }
                // Store new image
                $validated['image'] = $request->file('image')->store('deals', 'public');
                // $imagePath = $request->file('image')->store('deals', 'public');
                // $deal->image = $imagePath;

                // Get the uploaded image...
                // $image = $request->file('image');

                // Store the image...
                // $imageName = time().'.'.$image->getClientOriginalExtension();
                // $image->move(public_path('path/to/images'), $imageName);
            }

            // unset($validated['image']);

            // $deal->update([
            //     'image' => $imagePath,
            //     'is_active' => $request->has('is_active'),
            //     'is_featured' => $request->has('is_featured'),
            //     ...$validated
            // ]);

            // Update with validated data (now including processed image path)
            $deal->update($validated);

            return redirect()->route('business.deals.index')->with('success', 'Deal updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Error updating deal: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
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
