<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use File;

class ProductController extends Controller
{
    public function index()
    {
        $product=Product::join('categories', 'products.category_id', '=', 'categories.id')->latest()->get(['products.*', 'categories.name as cat_name']);
        return view('admin.product.index')->with('product',$product);
    }

    public function create()
    {
        $category=Category::get();
        return view('admin.product.create')->with('category',$category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'cover_image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]); 


        $slug = Str::slug($request->name);

        $product = Product::where('slug', $slug)->first();
        if($product){
            return back()->with('error', 'Product Already Exist');
        }
        
        $model = new Product();

        if($request->hasFile('cover_image'))
        {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->cover_image->move(public_path('uploads/product/'), $fileNameToStore);
            $model->cover_image = $fileNameToStore;
        }

        $model->name = $request->name;
        $model->slug = $slug;
        $model->category_id = $request->category_id;
        $model->desc = $request->desc;
        $model->price = $request->price;

        if($model->save()){
            $data = Product::where('slug', $slug)->first();
            if($request->hasFile('image_url')){
               foreach($request->file('image_url') as $file)
               {
                   $extension = $file->getClientOriginalExtension();
                   $filename = 'multipleImage'.rand(000000,999999).'.'.$extension;
                   $file->move('uploads/product/multiple_img/',$filename); 
                   $imgData = $filename;  
               
                   $multiple_img = new ProductImage();
                   $multiple_img->product_id = $data->id;
                   $multiple_img->image_url = $imgData;
                   $multiple_img->save();
               }
           }
          }

        return redirect('/admin/product')->with('success','Product Added Successfully');
    }

    public function show($slug)
    {
        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')->where('products.slug', $slug)->first(['products.*', 'categories.name as cat_name']);
        $multiple_img = ProductImage::where('product_id', $product->id)->get();
        return view('admin.product.show', compact('product', 'multiple_img'));
    }

    public function edit($slug)
    {
        $category = Category::get();
        $product = Product::where('slug', $slug)->first();
        $multiple_img = ProductImage::where('product_id', $product->id)->get();

        return view('admin.product.edit', compact('product', 'category', 'multiple_img'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'cover_image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]); 
       $create_slug = Str::slug($request->name);
        
       $model = Product::where('slug', $slug)->first();

       if($request->hasfile('cover_image')){
            $path = 'uploads/product/'.$model->cover_image;
            if($model->cover_image != 'default.jpg'){
                if(File::exists($path)){
                    File::delete($path);
                }
            }
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->cover_image->move(public_path('uploads/product/'), $fileNameToStore);
            $model->cover_image = $fileNameToStore;
        } 

        $model->name = $request->name;
        $model->slug = $create_slug;
        $model->category_id = $request->category_id;
        $model->desc = $request->desc;
        $model->price = $request->price;
        if($model->save()){
            $data = Product::where('slug', $slug)->first();
            if($request->hasFile('image_url')){
               foreach($request->file('image_url') as $file)
               {
                   $extension = $file->getClientOriginalExtension();
                   $filename = 'multipleImage'.rand(000000,999999).'.'.$extension;
                   $file->move('uploads/product/multiple_img/',$filename); 
                   $imgData = $filename;  
               
                   $multiple_img = new ProductImage();
                   $multiple_img->product_id = $data->id;
                   $multiple_img->image_url = $imgData;
                   $multiple_img->save();
               }
           }
          }

        return redirect('/admin/product')->with('success','Product Updated Successfully');

    }


    
    public function destroy($slug)
    {

        $model = Product::where('slug', $slug)->first();

        if($model->cover_image != 'default.jpg') {
              $path = 'uploads/product/'.$model->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $model->delete(); 
        }
        return back()->with('success','Product Deleted');
    }


    public function Status($status, $slug)
    {
        if ($status == "inactive") {
            $status = 0;
            $message = "Product Inactive";
  
        } elseif($status == "active") {
            $status = 1;
            $message = "Product Active";
        }
        $model = Product::where('slug', $slug)->first();
        if ($model != null) {
            $model->status = $status;
            $model->save();
             return back()->with('success', $message);
        }
    }

    public function DeleteImage(Request $request)
   {
     $Media = ProductImage::find($request->image_id);
       $path = 'uploads/product/multiple_img/'.$Media->image_url;
         if(File::exists($path))
         {
             File::delete($path);
         }
         $Media->delete(); 

     return response()->json(['Status' => 200, 'Message' => 'Image Deleted']);
   }
 
}
