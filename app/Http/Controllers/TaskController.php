<?php

namespace App\Http\Controllers;

use App\Filters\TaskFilter;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskFilter $filter)
    {
        // TaskFilter is from my own package "jerome/filterable". It basically
        // a simpler version of "spatie/laravel-query-builder".
        // e.g. /tasks?title=example-title
        $tasks = Task::filter($filter)->get();

        // The reason for using Resource classes is so we can restrict the data
        // that is returned from the API. This is useful for security reasons
        // and to prevent over-fetching.
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
