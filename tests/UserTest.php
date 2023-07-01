<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_login()
    {
        User::factory()->create([
            'email' => 'test1@ymail.com',
            'password' => 'test12345'
        ]);
        $response = $this->post('/api/auth/login', [
            'email' => 'test1@ymail.com',
            'password' => 'test12345'
        ]);
        $this->assertEquals(200, $response->status());
    }
}
