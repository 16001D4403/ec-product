<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB; // Import DB facade
use App\Models\User; // Adjust this namespace according to your User model

class UserTest extends TestCase
{
    use WithFaker;

    public function test_index_method()
    {
        // Create some sample users in the database
        $users = User::factory()->count(1)->create(['role' => 'user']);

        // Call the index method of the UserController
        $response = $this->get('/user-list');

        $response->assertStatus(200); // Check if the response is successful (status code 200)
    }

    public function test_homePage()
    {
        // Create some sample users in the database
        $users = User::factory()->count(1)->create(['role' => 'user']);

        // Call the homePage method of the HomeController
        $response = $this->get('/home');

        $response->assertStatus(200); // Check if the response is successful (status code 200)
    }

    public function test_addUser()
    {
        // Call the addUser method of the UserController
        $response = $this->get('/add-user');

        $response->assertViewIs('user.add-user'); // Check if the correct view is returned
    }

    public function test_editUser()
    {
        // Create a sample user in the database
        $user = User::factory()->create(['role' => 'user']);

        // Call the editUser method of the UserController with the user's ID
        $response = $this->get('/edit-user/' . $user->id);

        $response->assertViewIs('user.edit-user'); // Check if the correct view is returned
        $response->assertViewHas('data', $user); // Check if the user data is passed to the view correctly
    }

    public function test_saveUser_success()
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Generate fake user data using Faker
            $userData = [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'role' => 'user',
                'password' => 'password123', // Replace this with your preferred password generation logic or faker method
            ];

            // Send a POST request to the saveUser route with the generated user data
            $response = $this->post('/save-user', $userData);

            $response->assertRedirect(); // Check if it redirects somewhere after successful user creation

            // Check if the user exists in the database
            $this->assertDatabaseHas('users', [
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role'],
                // Add more assertions as needed for other user attributes
            ]);

            // Commit the changes to the database
            DB::commit();

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();
            throw $e; // Re-throw the exception after rolling back
        }
    }




    public function test_updateUser_success()
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Generate fake user data using Faker for initial user creation
            $userData = [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'role' => 'User',
                'password' => 'password123', // Replace this with your preferred password generation logic or faker method
            ];

            // Create a user in the database within the transaction
            $user = User::factory()->create($userData);

            // Generate updated user data using Faker
            $updatedUserData = [
                'id' => $user->id,
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'role' => 'Admin',
                'password' => 'newpassword123', // Replace this with your preferred password generation logic or faker method
            ];

            // Perform the update operation within the transaction
            // You would typically trigger your application logic here to update the user
            // For the sake of demonstration, let's assume updating the user via eloquent model
            $user->update($updatedUserData);

            // Commit the transaction to save changes to the database
            DB::commit();

            // Check if the user attributes are updated in the database after the commit
            $this->assertDatabaseHas('users', [
                'id' => $updatedUserData['id'],
                'name' => $updatedUserData['name'],
                'email' => $updatedUserData['email'],
                'role' => $updatedUserData['role'],
                // Add more assertions as needed for other user attributes
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
            throw $e; // Rethrow the exception to fail the test
        }

        // Clean up: Delete the created user after the test
        $user->delete();
    }


    public function test_deleteUser_success()
    {
        // Create a user in the database
        $user = User::factory()->create(['role' => 'user']);

        // Get the user ID
        $userId = $user->id;

        // Call the deleteUser method
        $response = $this->get('/delete-user/' . $userId);

        $response->assertRedirect(); // Check if it redirects somewhere after successful user deletion

         // Check if the user has been deleted from the database
         $deletedUser = User::find($userId);
         $this->assertNull($deletedUser, 'User should be deleted from the database.');
         // Deleting users whose email is like '@example.com'
         User::where('email', 'like', '%@example.%')->delete();

    }

}
