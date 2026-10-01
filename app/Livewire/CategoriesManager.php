<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CategoriesManager extends Component
{
    public string $name = '';

    protected array $rules = [
        'name' => 'required|string|min:2|max:255',
    ];

    public function createCategory(): void
    {
        $this->validate();

        Auth::user()->categories()->create([
            'name' => trim($this->name),
        ]);

        $this->reset('name');
        session()->flash('message', 'Category created successfully!');
    }

    public function deleteCategory(int $id): void
    {
        $category = Auth::user()->categories()->findOrFail($id);
        $category->delete();

        session()->flash('message', 'Category deleted successfully!');
    }

    public function render()
    {
        $categories = Auth::user()->categories()
            ->withCount('tasks')
            ->latest()
            ->get();

        return view('livewire.categories-manager', [
            'categories' => $categories,
        ]);
    }
}
