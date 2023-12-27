<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a list of products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Product::get();
        return view('product/product-list', compact('data'));
    }

    /**
     * Display the home page with a list of products.
     *
     * @return \Illuminate\View\View
     */
    public function homePage()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    /**
     * Display the form to add a new product.
     *
     * @return \Illuminate\View\View
     */
    public function addProduct()
    {
        return view('product/add-product');
    }

    /**
     * Save a new product to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProduct(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // Save the product to the database
        $prod = new Product();
        $prod->name = $name;
        $prod->price = $price;
        $prod->description = $description;
        $prod->image = $imagePath;
        $prod->save();

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    /**
     * Display the form to edit a product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editProduct($id)
    {
        $data = Product::where('id', '=', $id)->first();
        return view('product/edit-product', compact('data'));
    }

    /**
     * Update a product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;

        // Find the product in the database
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

    /**
     * Delete a product from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id)
    {
        Product::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    /**
     * Display the success page for payment handling.
     *
     * @return \Illuminate\View\View
     */
    public function handlepayment()
    {
        return view('product/success');
    }
}
