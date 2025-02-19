<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    // Show all categories for businesses
    public function businesses()
    {
        $categories = Category::withCount('businesses')->get();
        return view('categories/businesses', compact('categories'));
    }

    // Show all categories for deals
    public function deals()
    {
        $categories = Category::withCount('deals')->get();
        return view('categories.deals', compact('categories'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard', compact('categories'));
        // return view('categories.index', compact('categories'));
        // return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            // $request->validated();
            // Category::create($request->all());
            $category = Category::create($request->validated());
            // return redirect()->back()->with('success', 'Category added successfully');
            session()->flash('success', 'Category added successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            // return redirect()->back()->with('error', 'An error occurred while adding the category');
            session()->flash('error', 'An error occurred while adding the category');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // $category = Category::findOrFail($category);
        // $category = $request->validated();
        // $category->full_name = $request->input('name');
        // $category->save();
        $category->update($request->validated());
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $category = Category::findOrFail($category);
        $category->delete();
        return redirect()->route('dashboard');
    }
}
