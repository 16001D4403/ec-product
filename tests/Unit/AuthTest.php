<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function generateRandomEmail()
    {
        $randomString = bin2hex(random_bytes(5));
        // Generate a random hexadecimal string
        $email = "user_$randomString@example.com";
        return $email;
    }
    public function test_login_user()
    {
        $response = $this->post('login', [
            'email' => 'user_d154f1b729@example.com',
            'password' => '12345678'
        ]);
        $response->assertRedirect('/home');
    }

    public function test_register_user()
    {
        $randomEmail = $this->generateRandomEmail();
        $response = $this->post('register', [
            'name' => 'praveen',
            'email' => $randomEmail,
            'password' => '12345678',
            'confirmPass' => '12345678',
        ]);
        $response->assertRedirect('/login');
    }

    public function test_logout_user()
    {
        // Perform a logout action
        $response = $this->get('/logout');

        // Assert that the user is redirected to the login page
        $response->assertRedirect('/login');
    }
}
