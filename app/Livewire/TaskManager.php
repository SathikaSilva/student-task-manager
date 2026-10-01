<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class TaskManager extends Component
{
    use WithFileUploads;

    public string $filter = 'all'; // 'all', 'pending', 'completed'
    public string $search = '';

    // External API Quote
    public string $quote = '';
    public string $author = '';

    public function mount(): void
    {
        $this->loadMotivationalQuote();
    }

    public function loadMotivationalQuote(): void
    {
        try {
            $response = Http::timeout(3)->get('https://dummyjson.com/quotes/random');
            if ($response->successful() && isset($response['quote'])) {
                $this->quote = $response['quote'];
                $this->author = $response['author'] ?? 'Unknown';
                return;
            }
        } catch (\Throwable $e) {
            // Fallback on network timeout
        }

        $fallbackQuotes = [
            ['quote' => 'The secret of getting ahead is getting started.', 'author' => 'Mark Twain'],
            ['quote' => 'It always seems impossible until it is done.', 'author' => 'Nelson Mandela'],
            ['quote' => 'Success is the sum of small efforts repeated day in and day out.', 'author' => 'Robert Collier'],
        ];
        $random = $fallbackQuotes[array_rand($fallbackQuotes)];
        $this->quote = $random['quote'];
        $this->author = $random['author'];
    }

    // Form fields
    public bool $isModalOpen = false;
    public ?int $editingTaskId = null;
    public string $title = '';
    public string $description = '';
    public string $category_id = '';
    public string $due_date = '';
    public string $status = 'Pending';
    public $image;
    public ?string $existingImagePath = null;

    protected function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'nullable|date',
            'status' => 'required|in:Pending,Completed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ];
    }

    public function openCreateModal(): void
    {
        $this->resetValidation();
        $this->reset(['editingTaskId', 'title', 'description', 'category_id', 'due_date', 'status', 'image', 'existingImagePath']);
        $this->status = 'Pending';
        $this->isModalOpen = true;
    }

    public function openEditModal(int $id): void
    {
        $this->resetValidation();
        $task = Auth::user()->tasks()->findOrFail($id);

        $this->editingTaskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description ?? '';
        $this->category_id = $task->category_id ? (string) $task->category_id : '';
        $this->due_date = $task->due_date ? $task->due_date : '';
        $this->status = $task->status;
        $this->existingImagePath = $task->image_path;
        $this->image = null;

        $this->isModalOpen = true;
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
        $this->reset(['editingTaskId', 'title', 'description', 'category_id', 'due_date', 'status', 'image', 'existingImagePath']);
    }

    public function saveTask(): void
    {
        $this->validate();

        $imagePath = $this->existingImagePath;

        if ($this->image) {
            if ($this->existingImagePath && Storage::disk('public')->exists($this->existingImagePath)) {
                Storage::disk('public')->delete($this->existingImagePath);
            }

            $imagePath = $this->image->store('tasks', 'public');
        }

        $taskData = [
            'title' => trim($this->title),
            'description' => trim($this->description) ?: null,
            'category_id' => $this->category_id ?: null,
            'due_date' => $this->due_date ?: null,
            'status' => $this->status,
            'image_path' => $imagePath,
        ];

        if ($this->editingTaskId) {
            $task = Auth::user()->tasks()->findOrFail($this->editingTaskId);
            $task->update($taskData);
            session()->flash('message', 'Task updated successfully!');
        } else {
            Auth::user()->tasks()->create($taskData);
            session()->flash('message', 'Task created successfully!');
        }

        $this->closeModal();
    }

    public function toggleComplete(int $id): void
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->status = $task->status === 'Completed' ? 'Pending' : 'Completed';
        $task->save();

        session()->flash('message', 'Task status updated!');
    }

    public function deleteTask(int $id): void
    {
        $task = Auth::user()->tasks()->findOrFail($id);

        if ($task->image_path && Storage::disk('public')->exists($task->image_path)) {
            Storage::disk('public')->delete($task->image_path);
        }

        $task->delete();
        session()->flash('message', 'Task deleted successfully!');
    }

    public function render()
    {
        $user = Auth::user();

        // Statistics
        $totalTasks = $user->tasks()->count();
        $pendingTasks = $user->tasks()->where('status', 'Pending')->count();
        $completedTasks = $user->tasks()->where('status', 'Completed')->count();

        // Task Query with search & filter
        $query = $user->tasks()->with('category')->latest();

        if ($this->filter === 'pending') {
            $query->where('status', 'Pending');
        } elseif ($this->filter === 'completed') {
            $query->where('status', 'Completed');
        }

        if (trim($this->search) !== '') {
            $query->where('title', 'like', '%' . trim($this->search) . '%');
        }

        $tasks = $query->get();
        $categories = $user->categories()->orderBy('name')->get();

        return view('livewire.task-manager', [
            'tasks' => $tasks,
            'categories' => $categories,
            'totalTasks' => $totalTasks,
            'pendingTasks' => $pendingTasks,
            'completedTasks' => $completedTasks,
        ]);
    }
}
