<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson(route('api.tasks.destroy', $task));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_delete_non_existent_task(): void
    {
        $response = $this->deleteJson(route('api.tasks.destroy', 999));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
