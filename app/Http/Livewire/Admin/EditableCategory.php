<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;

class EditableCategory extends Component
{
    public string $name;
    public string $slug;
    public Category $category;
    public bool $isName = false;
    public string $level;
    public $selectedId = null;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category.name' => 'required',
            'category.slug' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.admin.editable-category');
    }

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function save()
    {
        $this->validate();
        $this->category->name = $this->name;
        $this->category->slug = $this->slug;
        $this->category->save();
    }

    public function updatedName()
    {
        $this->slug = SlugService::createSlug(Category::class, 'slug', $this->name);
    }
}
