<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StatusTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        $this->user = factory('App\User')->create();
    }

    /** @test */
    public function an_unauthenticated_user_should_be_redirected_to_login()
    {
        $this->withExceptionHandling();
        $this->get('/api/status')
             ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_can_retrieve_a_list_of_statuses()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user, 'api');

        $this->assertArrayHasKey(0,
            $this->get('/api/status')
                 ->assertOK()
                 ->decodeResponseJson());
    }
}
