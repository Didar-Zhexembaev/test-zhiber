<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class APITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_csrf_cookie()
    {
        $response = $this->get('/api/csrf-cookie');

        $response->assertStatus(204);
    }

    public function test_user()
    {
        $response = $this->withCookie('XSRF-TOKEN')->get('/api/csrf-cookie');
    }

    public function test_signup()
    {
        $response = $this->post('/api/signup', [
            'name' => 'NewUser',
            'email' => 'test@mail.ru',
            'password' => 'admin123Q*',
            'confirmPassword' => 'admin123Q*',
        ]);
        
        $response->dump();
    }
}
