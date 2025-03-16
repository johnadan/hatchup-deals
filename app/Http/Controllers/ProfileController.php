<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $categories = Category::all();
        // $currentCategory = $user->business->category;
        if ($user->role == 'business') {
            $business = $user->business;
            $currentCategory = $business->category;
        } else {
            $currentCategory = null;
        }
        return view('profile.edit', [
            'user' => $user,
            'currentCategory' => $currentCategory,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validated();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // if($request->has('image')) {
        //     $image = $request->file('image');
        //     $imageName = time().'.'.$image->extension();
        //     $image->move(public_path('images'), $imageName);
        //     $request->user()->profile_picture = $imageName;
        // }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // might not need this
        // if ($user->role == 'business') {
        //     $business = $user->business;
        //     $business->category_id = $request->input('category_id');
        //     $business->save();
        // }
        if ($user->role === 'business' && $request->has('category_id')) {
            $user->business()->update([
                'category_id' => $request->input('category_id')
            ]);
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profile successfully updated.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
