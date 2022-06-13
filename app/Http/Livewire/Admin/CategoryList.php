<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CategoryList extends Component
{
    public bool $simpleModal = true;
    public bool $confirmDeleteCategoryModal = false;
    public $categoryForDeleting = null;

    public $categoriesLv1 = [];
    public $categoriesLv2 = [];
    public $categoriesLv3 = [];

    public $selectedCategory1 = null;
    public $selectedCategory2 = null;
    public $selectedCategory3 = null;

    protected $listeners = [
        'categoryLv1Change' => 'onCategoryLv1Change',
        'categoryLv2Change' => 'onCategoryLv2Change',
        'categoryLv3Change' => 'onCategoryLv3Change',
        'confirmDeleteCategory',
        'refresh' => '$refresh',
    ];

    protected $rules = [
        'shownModal' => 'required',
        'categoriesLv2.*' => 'required',
        'categoryForDeleting' => 'nullable',
    ];

    public function render()
    {
        return view('livewire.admin.category-list');
    }

    public function mount()
    {
        $this->categoriesLv1 = Category::query()->where('parent_id', null)->get();
    }

    public function confirmDeleteCategory(Category $category)
    {
        $this->confirmDeleteCategoryModal = true;
        $this->categoryForDeleting = $category;
    }

    public function delete(Category $category)
    {
        if ($category->delete()) {
            $this->confirmDeleteCategoryModal = false;
            $this->categoryForDeleting = null;

            $this->categoriesLv1 = Category::where('parent_id', null)->get();
            $this->categoriesLv2 = Category::where('parent_id', $this->selectedCategory1)->get();
            $this->categoriesLv3 = Category::where('parent_id', $this->selectedCategory2)->get();
            //$this->emitSelf('refresh');
        }
    }

    public function onCategoryLv1Change(?Category $category)
    {
        $this->selectedCategory1 = $category->id;
        $this->selectedCategory2 = null;
        $this->selectedCategory3 = null;

        if ($category) {
            $this->categoriesLv2 = $category->children;
            $this->categoriesLv3 = [];
        } else {
            $this->categoriesLv2 = [];
            $this->categoriesLv3 = [];
        }
    }

    public function onCategoryLv2Change(?Category $category)
    {
        $this->selectedCategory2 = $category->id;
        $this->selectedCategory3 =  null;
        if ($category) {
            $this->categoriesLv3 = $category->children;
        } else {
            $this->categoriesLv3 = [];
        }
    }

    public function onCategoryLv3Change(?Category $category)
    {
        $this->selectedCategory3 = $category->id;
    }

    public function updateCategoryOrder($orders)
    {
        $mapCategoryIdToOrder = (array) collect($orders)->reduce(function ($result, $item) {
            $result[$item['value']] = $item['order'];
            return $result;
        }, []);

        $categories = Category::whereIn('id', array_keys($mapCategoryIdToOrder))->get();
        foreach ($categories as $category) {
            if ($category->order != $mapCategoryIdToOrder[$category->id]) {
                $category->order = $mapCategoryIdToOrder[$category->id];
                $category->save();
            }
        }
        $category = $categories->first();
        if ($category) {
            if ($category->parent_id === null) {
                $this->categoriesLv1 = Category::where('parent_id', null)->get();
            } elseif ($category->parent && $category->parent->parent === null && $this->selectedCategory1) {
                $this->categoriesLv2 = Category::where('parent_id', $this->selectedCategory1)->get();
            } elseif ($this->selectedCategory2) {
                $this->categoriesLv3 = Category::where('parent_id', $this->selectedCategory2)->get();
            }
        }

        // $this->emitSelf('refresh');
    }
}
