<?php

namespace App\Http\Controllers;

// use App\Models\Deal;
// use App\Models\DealCode;
// use App\Models\Order;
use App\Models\Category;
use App\Models\{Deal, Order, DealCode};
use App\Http\Requests\PurchaseDealRequest;
use App\Http\Requests\ClaimDealRequest;
use App\Http\Requests\StoreDealRequest;
use App\Http\Requests\UpdateDealRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DealController extends Controller
{
    // Show deals by category
    public function index(Category $category)
    {
        $deals = $category->deals;
        return view('deals.index', compact('category', 'deals'));
    }

    // Show individual deal details
    public function show(Deal $deal)
    {
        return view('deals.show', compact('deal'));
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('deals/index');
    // }

    /**
     * Show the form for creating a new resource.
     */
     // Show the form for creating a new deal
     public function create()
     {
         return view('deals.create');
        //  $categories = Category::all();
        // return view('deals.create', compact('categories'));
     }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreDealRequest $request)
    // {
    //      // The incoming request is valid...

    //     // Create a new deal using the validated data
    //     $deal = Deal::create($request->validated());

    //     // Redirect or return response
    //     return redirect()->route('deals.index')->with('success', 'Deal created successfully.');
    // }

    // Store a newly created deal in the database
    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'original_price' => 'required|numeric|min:0',
    //         'discounted_price' => 'required|numeric|min:0',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after:start_date',
    //         'max_usage_limit' => 'required|integer|min:1',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Handle image upload
    //     $imagePath = null;
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('deals', 'public');
    //     }

    //     // Create the deal
    //     Deal::create([
    //         'business_id' => Auth::id(), // The logged-in business user
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'original_price' => $request->original_price,
    //         'discounted_price' => $request->discounted_price,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         'max_usage_limit' => $request->max_usage_limit,
    //         'image' => $imagePath,
    //     ]);

    //     return redirect()->route('deals.index')->with('success', 'Deal created successfully!');
    // }

    // public function store(StoreDealRequest $request)
    // {
    //     $imagePath = $request->hasFile('image') ? $request->file('image')->store('deals', 'public') : null;
    //     // if ($request->hasFile('image')) {
    //     //     $imagePath = $request->file('image')->store('deals', 'public');
    //     //     $request['image'] = $imagePath;
    //     // }
    //     $business = auth()->user()->business;
    //     $category = $business->category;
    //     Deal::create([
    //         'business_id' => Auth::id(),
    //         'image' => $imagePath,
    //         // 'category_id' => $request->category_id,
    //         'category_id' => $category->id,
    //         ...$request->validated(),
    //     ]);

    //     return redirect()->route('deals.index')->with('success', 'Deal created successfully!');
    // }

    // public function purchaseDeal(Request $request, $dealId)
    public function purchase(PurchaseDealRequest $request)
    {
        // $deal = Deal::findOrFail($dealId);
        $deal = Deal::findOrFail($request->deal_id);
        $customerId = Auth::id();
        // $customerId = auth()->id(); // Assuming the customer is logged in

        // Check if the deal has reached its max usage limit
        if ($deal->current_usage_count >= $deal->max_usage_limit) {
            return response()->json(['message' => 'This deal is no longer available.'], 400);
        }

        // Check if the deal is free
        // $isFreeDeal = $deal->discounted_price == 0;

        // Create an order
        // $order = new Order();
        // $order->customer_id = $customerId;
        // $order->deal_id = $dealId;
        // $order->order_date = now();
        // $order->total_price = $isFreeDeal ? 0 : $deal->discounted_price;
        // $order->payment_status = $isFreeDeal ? 'completed' : 'pending';
        // $order->payment_id = $isFreeDeal ? 'free_deal' : null; // Placeholder for free deals
        // $order->save();

        // Create an order
        $order = Order::create([
            'customer_id' => $customerId,
            'deal_id' => $deal->id,
            'order_date' => now(),
            'total_price' => $deal->discounted_price,
            'payment_status' => 'completed',
            'payment_id' => 'free_deal', // Placeholder for free deals
        ]);

        // Generate a unique deal code
        // $dealCode = new DealCode();
        // $dealCode->order_id = $order->id;
        // $dealCode->deal_code = $this->generateUniqueDealCode(); // Implement this function
        // $dealCode->is_claimed = false;
        // $dealCode->save();

        // Generate a unique deal code
        $dealCode = DealCode::create([
            'order_id' => $order->id,
            'deal_code' => Str::uuid(),
            'is_claimed' => false,
        ]);

        // If not a free deal, redirect to payment gateway
        // if (!$isFreeDeal) {
        //     return redirect()->route('payment.process', $order->id);
        // }

        // For free deals, return the deal code
        return response()->json([
            'message' => 'Deal purchased successfully!',
            'deal_code' => $dealCode->deal_code,
        ]);
    }

    private function generateUniqueDealCode()
    {
        // Implement logic to generate a unique code (e.g., UUID or custom alphanumeric)
        return uniqid('DEAL_');
    }

    // public function claimDeal(Request $request)
    public function claim(ClaimDealRequest $request)
    {
        return DB::transaction(function () use ($request) {
            // $dealCodeValue = $request->input('deal_code');
            // $dealCode = DealCode::where('deal_code', $dealCodeValue)->lockForUpdate()->first();
            $dealCode = DealCode::where('deal_code', $request->deal_code)->lockForUpdate()->first();

            // if (!$dealCode) {
            //     return response()->json(['message' => 'Invalid deal code.'], 404);
            // }

            if ($dealCode->is_claimed) {
                return response()->json(['message' => 'Deal already claimed.'], 400);
            }

            $order = $dealCode->order;
            $deal = $order->deal;

            // Check if the deal has reached its max usage limit
            if ($deal->current_usage_count >= $deal->max_usage_limit) {
                return response()->json(['message' => 'This deal has reached its maximum usage limit.'], 400);
                // Notify the business (e.g., send an email or notification)
                $this->notifyBusiness($deal->business_id, 'Deal usage limit reached.');
            }

            if (now() > $deal->end_date) {
                return response()->json(['message' => 'Deal has expired.'], 400);
            }

            // Mark the deal as claimed
            $dealCode->is_claimed = true;
            $dealCode->claimed_at = now();
            $dealCode->save();

            // Increment the usage count for the deal
            $deal->current_usage_count += 1;
            $deal->save();

            return response()->json(['message' => 'Deal claimed successfully!']);
        });
    }

    /**
     * Display the specified resource.
     */
    // public function show(Deal $deal)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        return view('deals.edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDealRequest $request, Deal $deal)
    {
        if ($request->hasFile('image')) {
            if ($deal->image) {
                Storage::disk('public')->delete($deal->image);
            }
            $imagePath = $request->file('image')->store('deals', 'public');
            $deal->image = $imagePath;
        }

        $deal->update($request->validated());

        return redirect()->route('deals.index')->with('success', 'Deal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        //
    }

    public function generateQrCode($orderId)
    {
        // Generate a unique deal code (e.g., UUID)
        $dealCode = Str::uuid();

        // Store the deal code in the database
        DealCode::create([
            'order_id' => $orderId,
            'deal_code' => $dealCode,
            'is_claimed' => false,
        ]);

        // Generate the QR code
        $qrCode = QrCode::size(300)->generate($dealCode);

        // Return the QR code (e.g., as an image or base64)
        return $qrCode;
    }

    public function validateDeal(Request $request)
    {
        $request->validate([
            'deal_code' => 'required|string',
        ]);

        $dealCode = DealCode::where('deal_code', $request->deal_code)->first();

        if (!$dealCode) {
            return response()->json(['message' => 'Invalid QR code.'], 404);
        }

        if ($dealCode->is_claimed) {
            return response()->json(['message' => 'Deal already claimed.'], 400);
        }

        $order = $dealCode->order;
        $deal = $order->deal;

        // Check if the deal has expired
        if (now() > $deal->end_date) {
            return response()->json(['message' => 'Deal has expired.'], 400);
        }

        // Check if the deal has reached its max usage limit
        if ($deal->current_usage_count >= $deal->max_usage_limit) {
            return response()->json(['message' => 'Deal usage limit reached.'], 400);
        }

        // Mark the deal as claimed
        $dealCode->is_claimed = true;
        $dealCode->claimed_at = now();
        $dealCode->save();

        // Increment the usage count for the deal
        $deal->current_usage_count += 1;
        $deal->save();

        return response()->json(['message' => 'Deal claimed successfully!']);
    }
}
