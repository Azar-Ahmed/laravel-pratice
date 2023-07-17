<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Category::paginate(3);
        return view('admin.category.index')->with('category',$category);
    }


    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
        ]); 


        $slug = Str::slug($request->name);

        $category = Category::where('slug', $slug)->first();
        if($category){
            return back()->with('error', 'Category Already Exist');
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        return redirect('/admin/category')->with('success','Category Added Successfully');
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('admin.category.show')->with('category',$category);
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('admin.category.edit')->with('category', $category);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
        ]); 

        $create_slug = Str::slug($request->name);
        
        Category::where('slug', $slug)->update(['name' => $request->name, 'slug' => $create_slug]);

        return redirect('/admin/category')->with('success','Category Updated Successfully');
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return back()->with('success','Category Deleted Successfully');
    }
}
