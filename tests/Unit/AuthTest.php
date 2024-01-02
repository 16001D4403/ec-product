<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login_user()
    {
        $response = $this->post('login', [            
            'email' => 'iq@ecc.com',            
            'password' => '12345678'
        ]);
        $response->assertRedirect('/home');
    }

    public function test_register_user(){
        $response = $this->post('register', [
            'name' => 'praveen',
            'email' => 'praveensingh63@gmail.com',
            'password' => '12345678',
            'confirmPass' => '12345678',
        ]);
        $response->assertRedirect('/login');
    }

    public function test_logout_user(){
    // Perform a logout action
    $response = $this->get('/logout');

    // Assert that the user is redirected to the login page
    $response->assertRedirect('/login');
    }
}
