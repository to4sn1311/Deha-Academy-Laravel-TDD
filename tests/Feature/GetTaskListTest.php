<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetTaskListTest extends TestCase
{
    public function getTaskListRoute()
    {
        return route('tasks.index');
    }
    /**
     * A basic feature test example.
     */
    /** @test */
    public function user_can_get_all_tasks(): void
    {
        $data = Task::factory()->create();

        $response = $this->get($this->getTaskListRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.index');
        $response->assertSee($data->name);
    }
}
