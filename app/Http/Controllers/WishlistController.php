<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        // Retrieve wishlist items for the authenticated user
        $wishlistItems = Wishlist::where('user_id', auth()->id())->with('product')->get();

        return view('wishlist.index', compact('wishlistItems'));
    }
    
    public function addToWishlist(Request $request)
    {
        $productId = $request->productId;

        // Get the product by ID
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Check if the product already exists in the wishlist for the user (you may need to modify this logic)
        $isProductInWishlist = Wishlist::where('product_id', $productId)
                                        ->where('user_id', auth()->id()) // Assuming users are authenticated
                                        ->exists();

        if ($isProductInWishlist) {
            return response()->json(['error' => 'Product already in wishlist'], 400);
        }

        // Add product to the user's wishlist
        Wishlist::create([
            'user_id' => auth()->id(), // Assuming users are authenticated
            'product_id' => $productId,
        ]);

        return response()->json(['success' => 'Product added to wishlist']);
    }
}
