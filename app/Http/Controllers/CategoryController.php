<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::all();

        return view("allcategory", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Category.addcategory");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Validator::make($request->all(), [
            "cname" => "required|string|max:255",
        ]);
        $category = Category::create([
            "name" => $request->cname,
        ]);

        if ($category) {
            return redirect()->route('allcategories.index')->with("success", "Category added successfully!");
        } else {
            return redirect()->route('allcategories.index')->with("error", "Error, Category not added. Try again!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category= Category::findOrFail($id);

        return view("Category.categorydetails", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category= Category::findOrFail($id);

        return view("Category.updatecategory", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate( [
            "cname" => "required|string|max:255",
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            "name" => $request->cname,
        ]);
        if ($category) {
            return redirect()->route('allcategories.index')->with("success", "Category Updated Successfully!");
        } else {
            return redirect()->route('allcategories.index')->with("error", "Error, Updating Category! Try Again.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categoty,$id)
    {
        $category=Category::findOrFail( $id);
        $category->delete();
        return redirect()->route('allcategories.index')->with("success","Category Deleted successfully!");

    }
}
