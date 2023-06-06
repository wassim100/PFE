<?php


use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Integeration_Test()
    {
        $response = $this->post('/login', [
            'email' => 'sassoumi88@gmail.com',
            'password' => '12345678'
        ]);
        
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Database()
    {
 
        $this->assertDatabaseHas('users', [
            'email' => 'sassoumi88@gmail.com'
        ]);
    }
}
