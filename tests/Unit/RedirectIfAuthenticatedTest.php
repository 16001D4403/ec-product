<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfAuthenticated;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;
use Database\Factories\UserFactory; // Import the UserFactory

class RedirectIfAuthenticatedTest extends TestCase
{
    // use RefreshDatabase; // Use RefreshDatabase trait

    public function testRedirectIfAuthenticatedRedirectsToHomeIfUserIsAuthenticated()
    {
        // Create a user and authenticate them
        $user = UserFactory::new()->create(); // Use the UserFactory
        Auth::login($user);

        // Create a mock request
        $request = Request::create('/some-url', 'GET');

        // Create an instance of the middleware
        $middleware = new RedirectIfAuthenticated();

        // Call the handle method and assert redirection
        $response = $middleware->handle($request, function () {
            // This function should not be called due to redirection
        });

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(RouteServiceProvider::HOME, $response->headers->get('Location'));
    }

    public function testRedirectIfAuthenticatedPassesThroughIfUserIsNotAuthenticated()
    {
        // Create a mock request
        $request = Request::create('/some-url', 'GET');

        // Create an instance of the middleware
        $middleware = new RedirectIfAuthenticated();

        // Call the handle method and assert that it passes through
        $response = $middleware->handle($request, function ($request) {
            return new Response('Passed Through', 200);
        });

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Passed Through', $response->getContent());
    }

    public function testRedirectIfAuthenticatedRedirectsToCustomRouteIfUserIsAuthenticated()
    {
        // Create a user and authenticate them
        $user = UserFactory::new()->create(); // Use the UserFactory
        Auth::login($user);

        // Create a mock request
        $request = Request::create('/some-url', 'GET');

        // Create an instance of the middleware with a custom guard name
        $middleware = new RedirectIfAuthenticated('admin');

        // Call the handle method and assert redirection to a custom route
        $response = $middleware->handle($request, function () {
            // This function should not be called due to redirection
        });

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(RouteServiceProvider::HOME, $response->headers->get('Location'));
    }
}
