<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateNewTaskTest extends TestCase
{
    public function getCreateTaskRoute()
    {
        return route('tasks.store');
    }

    public function getCreateTaskViewRoute()
    {
        return route('tasks.create');
    }

    /** @test */
    public function authenticated_user_can_create_new_task(): void
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make()->toArray();
        $response = $this->post($this->getCreateTaskRoute(), $task);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', $task);
        $response->assertRedirect(route('tasks.index'));
    }

    /** @test */
    public function unauthenticated_user_cannot_create_new_task(): void
    {
        $task = Task::factory()->make()->toArray();
        $response = $this->post($this->getCreateTaskRoute(), $task);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_cannot_create_new_task()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make(['name' => null])->toArray();
        $response = $this->post($this->getCreateTaskRoute(), $task);
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_can_view_task_form()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('tasks.create'));

        $response->assertViewIs('tasks.create');
    }

    /** @test */
    public function authenticated_user_can_see_name_required_error_if_name_is_not_provided()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->make(['name' => null])->toArray();
        $response = $this->from($this->getCreateTaskViewRoute())->post($this->getCreateTaskRoute(), $task);
        $response->assertRedirect($this->getCreateTaskViewRoute());

    }

    /** @test */
    public function unauthenticated_user_cannot_see_create_task_form_view()
    {
        $task = Task::factory()->make(['name' => null])->toArray();
        $response = $this->from($this->getCreateTaskViewRoute())->post($this->getCreateTaskRoute(), $task);
        $response->assertRedirect('/login');
    }
}
