<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Display a listing of the books
    public function index()
    {
        $products = Product::all();
        return view('books.index', compact('books'));
    }
    public function homePage()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        return view('books.create');
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required',
            'Author' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $imagePath = $request->file('image')->store('public/images');
        $book = new Book();
        $book->Title = $request->input('Title');
        $book->Author = $request->input('Author');
        $book->ISBN = $request->input('ISBN');
        $book->Genre = $request->input('Genre');
        $book->Publisher = $request->input('Publisher');
        $book->Year = $request->input('Year');
        $book->Price = $request->input('Price');
        $book->description = $request->input('description');
        $book->image = $imagePath; // Assuming 'image' is the field in your database table for storing the image path
        $book->save();
        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    // Display the specified book
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Show the form for editing the specified book
    public function edit($book)
    {
        $book = Book::findOrFail($book);
        return view('books.edit', compact('book'));
    }

    // Update the specified book in the database
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'Title' => 'required',
            'Author' => 'required',
            // Add other validation rules as needed
        ]);
    
        // Check if a new image is provided in the form
        if ($request->hasFile('image')) {
            // Delete the old image (optional)
            if ($book->image) {
                // Remove 'public/' from the image path before deleting
                Storage::delete(str_replace('public/', '', $book->image));
            }
    
            // Upload and store the new image
            $imagePath = $request->file('image')->store('public/images');
    
            // Update the book's image attribute with the new image path
            $book->image = str_replace('public/', '', $imagePath);
        }
    
        // Update the book's other attributes
        $book->update($request->except('image'));
    
        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    // Remove the specified book from the database
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }
}
