<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class FetchTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_tasks(): void
    {
        $task = Task::factory()->create();

        $response = $this->getJson(route('api.tasks.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    [
                        'id' => $task->id,
                        'title' => $task->title,
                        'description' => $task->description,
                    ],
                ],
            ]);
    }

    public function test_fetch_tasks_with_filter(): void
    {
        $task1 = Task::factory()->create(['title' => 'Task 1']);
        $task2 = Task::factory()->create(['title' => 'Task 2']);

        $response = $this->getJson(route('api.tasks.index', ['title' => 'Task 1']));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    [
                        'id' => $task1->id,
                        'title' => $task1->title,
                        'description' => $task1->description,
                    ],
                ],
            ]);
    }

    public function test_fetch_specific_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->getJson(route('api.tasks.show', $task));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                ],
            ]);
    }
}
