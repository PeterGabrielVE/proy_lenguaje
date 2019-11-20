<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IsAdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function user_should_be_rejected(){
    	$user = factory(\App\User::class)->create();

    	$this->be($user);

    	$this->call('GET', '/admin/users');

    	$this->assertResponseStatus(301);

    	$this->visit('/admin/users')->see("You need to be an admin to see this page");
    }
}
