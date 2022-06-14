<?php

namespace App\Http\Livewire\Traits;

use App\Models\Category;

trait CategorySelectable
{
    public $categoriesLv1 = [];
    public $categoriesLv2 = [];
    public $categoriesLv3 = [];

    public $selectedCategory1 = null;
    public $selectedCategory2 = null;
    public $selectedCategory3 = null;
    public $selectedCategory = null;

    protected function getSelectedCategory()
    {
        return $this->selectedCategory3 ?? $this->selectedCategory2 ?? $this->selectedCategory3; 
    }

    protected function setSelectedCategory(Category $category)
    {
        $this->selectedCategory = $category;
        if($category?->parent?->parent){
            $this->selectedCategory1 = $category->parent->parent->id;
            $this->selectedCategory2 = $category->parent->id;
            $this->selectedCategory3 = $category->id;

            $this->categoriesLv2 = $category->parent->parent->children;
            $this->categoriesLv3 = $category->parent->children;
        }else if($category?->parent){
            $this->selectedCategory1 = $category->parent->id;
            $this->selectedCategory2 = $category->id;
            $this->categoriesLv2 = $category->parent->children;
            $this->categoriesLv3 = $category->children;
        }else if($category){
            $this->selectedCategory1 = $category->id;
        }
    }


    public function updatedSelectedCategory1()
    {
        $this->selectedCategory2 = null;
        $this->selectedCategory3 = null;
        $this->categoriesLv2 = [];
        $this->categoriesLv3 = [];

        if ($this->selectedCategory1) {
            $category = Category::find($this->selectedCategory1);
            $this->categoriesLv2 = $category->children;
            $this->selectedCategory =$category;
        }
    }

    public function updatedSelectedCategory2()
    {
        $this->selectedCategory3 =  null;
        $this->categoriesLv3 = [];
        if ($this->selectedCategory2) {
            $category = Category::find($this->selectedCategory2);
            $this->categoriesLv3 = $category->children;
            $this->selectedCategory = $category;
        }
    }

    public function updatedSelectedCategory3()
    {
        if($this->selectedCategory3){
            $this->selectedCategory = Category::find($this->selectedCategory3);
        }
    }
}
