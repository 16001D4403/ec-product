<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductTest extends TestCase
{
    protected $productController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productController = new ProductController();
    }

    public function test_index()
    {
        $productsCount = Product::count();
        
        // Create sample products for testing
        Product::create(['name' => 'Product 1', 'price' => 10.99, 'description' => 'Description 1']);
        Product::create(['name' => 'Product 2', 'price' => 20.99, 'description' => 'Description 2']);

        // Call the index method of the ProductController
        $response = $this->productController->index();

        // Check if the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Check if the view returned is 'product/product-list'
        $this->assertEquals('product.product-list', $response->getName());

        // Check if the view has 'data' variable
        $this->assertArrayHasKey('data', $response->getData());

        // Get the 'data' variable from the view
        $data = $response->getData()['data'];

        // Check if the 'data' variable is an instance of Collection (assuming Product::get() returns a Collection)
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $data);

        // Check if the number of products returned in the view matches the number of products created for testing
        $this->assertEquals(2+ $productsCount, $data->count());

        // Clean up - delete the created products (optional)
        //Product::truncate(); // Delete all products from the database
    }


    public function test_homePage()
    {
        $productsCount = Product::count();

        // Create sample products for testing
        // Product::create(['name' => 'Product 1', 'price' => 10.99, 'description' => 'Description 1']);
        // Product::create(['name' => 'Product 2', 'price' => 20.99, 'description' => 'Description 2']);

        $product = Product::insert([
            [
                'name' => 'Product 1',
                'price' => 10.99,
                'description' => 'Description 1'
            ],
            [
                'name' => 'Product 2',
                'price' => 20.99,
                'description' => 'Description 2'
            ]
        ]);
        // Call the homePage method of the ProductController
        $response = $this->productController->homePage();

        // Check if the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Check if the view returned is 'home'
        $this->assertEquals('home', $response->getName());

        // Check if the view has 'products' variable
        $this->assertArrayHasKey('products', $response->getData());

        // Get the 'products' variable from the view
        $products = $response->getData()['products'];

        // Check if the 'products' variable is an instance of Collection (assuming Product::all() returns a Collection)
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $products);

        // Check if the number of products returned in the view matches the number of products created for testing
        $this->assertEquals(2 + $productsCount, $products->count());

        // Clean up - delete the created products
        Product::where('name', 'Product 1')->delete();
        Product::where('name', 'Product 2')->delete();
    }
    
    public function test_addProduct()
    {
        // Call the addProduct method of the ProductController
        $response = $this->productController->addProduct();

        // Check if the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Check if the view returned is 'product/add-product'
        $this->assertEquals('product.add-product', $response->getName());
        
    }

    public function test_editProduct()
    {
        // Create a sample product for testing
        $product = Product::create(['name' => 'Test Product', 'price' => 15.99, 'description' => 'Test Description']);

        // Call the editProduct method of the ProductController with the created product's ID
        $response = $this->productController->editProduct($product->id);

        // Check if the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Check if the view returned is 'product/edit-product'
        $this->assertEquals('product.edit-product', $response->getName());

        // Check if the view contains the 'data' variable
        $this->assertArrayHasKey('data', $response->getData());

        // Get the 'data' variable from the view
        $data = $response->getData()['data'];

        // Check if the 'data' variable is an instance of Product
        $this->assertInstanceOf(Product::class, $data);

        // Check if the ID of the retrieved product matches the created product's ID
        $this->assertEquals($product->id, $data->id);

        // Clean up - delete the created product (optional)
        $product->delete();
    }

    public function test_saveProduct()
    {
        // Simulate request data    
        $requestData = [
            'name' => 'Test Product',
            'price' => 10.99,
            'description' => 'This is a test product description.',
            // ... other data
        ];

        $image = UploadedFile::fake()->image('test_image.jpg');

        // Create a mocked request with required data
        $request = new \Illuminate\Http\Request($requestData);
        $request->files->add(['image' => $image]);

        // Before the save operation, assert that no product with the same name exists
        $this->assertNull(Product::where('name', 'Test Product')->first());

        // Call the saveProduct method of the ProductController
        $response = $this->productController->saveProduct($request);

        // Check if the product was added successfully to the database
        $this->assertNotNull(Product::where('name', 'Test Product')->first());

        // Check if the response redirects back with a success message
        $this->assertEquals('Product added successfully.', session('success'));

        // Clean up - delete the created product and the uploaded image
        $product = Product::where('name', 'Test Product')->first();
        if ($product) {
            $product->delete();
        }
        Storage::delete($product->image); // Delete the uploaded image
    }

    


    public function test_updateProduct()
    {
        // Create a sample product for updating
        $product = Product::create([
            'name' => 'Original Product Name',
            'price' => 10.99,
            'description' => 'Original product description',
            // ... other data
        ]);

        // Simulate request data for updating the product
        $requestData = [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'price' => 15.99,
            'description' => 'Updated product description',
            // ... other data
        ];

        $image = UploadedFile::fake()->image('updated_image.jpg');

        // Create a mocked request with updated product data and a new image
        $request = new \Illuminate\Http\Request($requestData);
        $request->files->add(['image' => $image]);

        // Call the updateProduct method of the ProductController
        $response = $this->productController->updateProduct($request);

        // Check if the product was updated successfully in the database
        $updatedProduct = Product::findOrFail($product->id);
        $this->assertEquals('Updated Product Name', $updatedProduct->name);
        $this->assertEquals(15.99, $updatedProduct->price);
        $this->assertEquals('Updated product description', $updatedProduct->description);
        // ... other assertions for updated fields

        // Check if the response redirects back with a success message
        $this->assertEquals('Product updated successfully.', session('success'));

        // Clean up - delete the updated product and the updated image
        $updatedProduct->delete();
        Storage::delete($updatedProduct->image); // Delete the updated image
    }


    public function test_deleteProduct()
    {
        // Create a sample product to be deleted
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 19.99,
            'description' => 'Sample product description',
            // ... other fields
        ]);

        // Get the ID of the created product
        $productId = $product->id;

        // Call the deleteProduct method of the ProductController
        $response = $this->productController->deleteProduct($productId);

        // Check if the product was deleted from the database
        $deletedProduct = Product::find($productId);
        $this->assertNull($deletedProduct);

        // Check if the response redirects back with a success message (assuming redirection logic)
        // $this->assertEquals('Product deleted successfully.', session('success'));
    }
}

