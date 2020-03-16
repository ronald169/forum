<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_can_browse_threads()
    {
        $thread = factory('App\Models\Thread')->create();

        $response = $this->get('/threads');

//        $response->assertStatus(200);

        $response->assertSee($thread->title);
    }
}
