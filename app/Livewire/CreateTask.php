<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTask extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $category_id = '';
    public $due_date = '';
    public $status = 'Pending';
    public $image;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'due_date' => 'required|date',
        'status' => 'required|in:Pending,Completed',
        'image' => 'nullable|image|max:2048',
    ];

    public function saveTask()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('tasks_images', 'public');
        }

        auth()->user()->tasks()->create([
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id ?: null,
            'due_date' => $this->due_date ?: null,
            'status' => $this->status,
            'image_path' => $imagePath,
        ]);

        session()->flash('message', 'Task created successfully!');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        $categories = auth()->user()->categories()->orderBy('name')->get();

        return view('livewire.create-task', [
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
