<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_task(): void
    {
        $task = Task::factory()->create();

        $data = [
            'title' => 'Updated Task',
            'description' => 'Updated description',
        ];

        $response = $this->putJson(route('api.tasks.update', $task), $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'title' => 'Updated Task',
                    'description' => 'Updated description',
                ],
            ]);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_update_task_validation_errors(): void
    {
        $task = Task::factory()->create();

        $response = $this->putJson(route('api.tasks.update', $task), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_update_task_partial_update(): void
    {
        $task = Task::factory()->create();

        $data = [
            'title' => 'Partially Updated Task',
        ];

        $response = $this->patchJson(route('api.tasks.update', $task), $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'title' => 'Partially Updated Task',
                    'description' => $task->description,
                ],
            ]);

        $this->assertDatabaseHas('tasks', $data);
    }
}
