<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     */
    public function index(Request $request): JsonResponse
    {
        $tasks = $request->user()->tasks()->with('category')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Tasks retrieved successfully.',
            'data' => $tasks,
        ], 200);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:Pending,Completed',
        ]);

        $task = $request->user()->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'status' => $validated['status'] ?? 'Pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'data' => $task->load('category'),
        ], 201);
    }

    /**
     * Display the specified task.
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $task = $request->user()->tasks()->with('category')->find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found or access denied.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task,
        ], 200);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $task = $request->user()->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found or access denied.',
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'nullable|date',
            'status' => 'sometimes|required|in:Pending,Completed',
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully.',
            'data' => $task->fresh('category'),
        ], 200);
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $task = $request->user()->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found or access denied.',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.',
        ], 200);
    }
}
