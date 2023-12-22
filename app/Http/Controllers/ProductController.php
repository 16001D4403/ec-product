<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $data = Product::get();
        return view('product/product-list', compact('data'));
    }
    public function homePage()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }
    public function addProduct(){
        return view('product/add-product');
    }
    
    public function saveProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Add validation rules for the image
        ]);
    
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;
    
        // Check if the product already exists in the database
        $existingProduct = Product::where('name', $name)->first();
        if ($existingProduct) {
            return redirect()->back()->with('error', 'Product with this name already exists.');
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        } else {
            $imagePath = null;
        }
    
        $prod = new Product();
        $prod->name = $name;
        $prod->price = $price;
        $prod->description = $description;
        $prod->image = $imagePath; // Save the image path to the database
        $prod->save();
    
        return redirect()->back()->with('success', 'Product added successfully.');
    }
    
    
    public function editProduct($id){
        $data = Product::where('id','=',$id)->first();
        return view('product/edit-product', compact('data'));
    }
    public function updateProduct(Request $request) {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;
    
        $product = Product::findOrFail($id);
    
        // Check if a new image is being uploaded
        if ($request->hasFile('image')) {
            // Handle the uploaded image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
    
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
    
            // Update the image field in the database
            $product->image = 'images/' . $imageName;
        }
    
        // Update other fields
        $product->name = $name;
        $product->price = $price;
        $product->description = $description;
        $product->save();
    
        return redirect()->back()->with('success', 'Product updated successfully.');
    }
    
    public function deleteProduct($id){
       Product::where('id','=',$id)->delete();
       return redirect()->back() ->with('success', 'Product deleted successfully.');

    }
}
