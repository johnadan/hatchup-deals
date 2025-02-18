<?php

namespace App\Http\Controllers;

// use App\Models\Favorite;
use App\Models\{Favorite, User, Deal};
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreFavoriteRequest $request)
    // {
    //     //
    // }

    // Add a business or deal to favorites
    public function store(Request $request)
    {
        $request->validate([
            'favoriteable_id' => 'required|integer',
            'favoriteable_type' => 'required|in:business,deal',
        ]);

        $user = auth()->user();
        $favoriteableType = $request->favoriteable_type === 'business' ? User::class : Deal::class;

        $user->favorites()->create([
            'favoriteable_id' => $request->favoriteable_id,
            'favoriteable_type' => $favoriteableType,
        ]);

        return redirect()->back()->with('success', 'Added to favorites!');
    }

    // Remove a business or deal from favorites
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return redirect()->back()->with('success', 'Removed from favorites!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Favorite $favorite)
    // {
    //     //
    // }
}
