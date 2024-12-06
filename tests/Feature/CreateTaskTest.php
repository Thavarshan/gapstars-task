<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_task(): void
    {
        $data = [
            'title' => 'New Task',
            'description' => 'Task description',
        ];

        $response = $this->postJson(route('api.tasks.store'), $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'data' => [
                    'title' => 'New Task',
                    'description' => 'Task description',
                ],
            ]);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_create_task_validation_errors(): void
    {
        $response = $this->postJson(route('api.tasks.store'), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_create_task_title_required(): void
    {
        $data = [
            'description' => 'Task description',
        ];

        $response = $this->postJson(route('api.tasks.store'), $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_create_task_description_is_optional(): void
    {
        $data = [
            'title' => 'New Task',
        ];

        $response = $this->postJson(route('api.tasks.store'), $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'data' => [
                    'title' => 'New Task',
                    'description' => null,
                ],
            ]);
    }
}

