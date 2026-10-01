<?php

namespace Tests\Feature;

use App\Livewire\CategoriesManager;
use App\Livewire\TaskManager;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StudentTaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_create_category_via_livewire(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CategoriesManager::class)
            ->set('name', 'Assignments')
            ->call('createCategory')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('categories', [
            'user_id' => $user->id,
            'name' => 'Assignments',
        ]);
    }

    public function test_student_can_create_task_via_livewire(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['user_id' => $user->id, 'name' => 'Exams']);

        Livewire::actingAs($user)
            ->test(TaskManager::class)
            ->set('title', 'Study for Math Exam')
            ->set('description', 'Chapters 1 to 4')
            ->set('category_id', (string) $category->id)
            ->set('due_date', '2026-10-25')
            ->set('status', 'Pending')
            ->call('saveTask')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title' => 'Study for Math Exam',
            'status' => 'Pending',
        ]);
    }

    public function test_student_can_toggle_task_completion(): void
    {
        $user = User::factory()->create();
        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Submit Report',
            'status' => 'Pending',
        ]);

        Livewire::actingAs($user)
            ->test(TaskManager::class)
            ->call('toggleComplete', $task->id);

        $this->assertEquals('Completed', $task->fresh()->status);
    }

    public function test_authenticated_student_can_access_sanctum_api(): void
    {
        $user = User::factory()->create();
        Task::create([
            'user_id' => $user->id,
            'title' => 'API Task Test',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.0.title', 'API Task Test');
    }
}
