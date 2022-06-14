<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\CategorySelectable;
use App\Models\Category;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;

class ProductGeneralInformation extends Component
{
    use CategorySelectable;

    public Product $product;
    public string $name;
    public string $slug;

    protected $rules = [
        'name' => 'required|string|min:2|max:50',
        'slug' => 'required|string|min:2|max:50',
        'product.description' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.admin.product-general-information');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->categoriesLv1 = Category::where('parent_id', null)->get();
        $this->setSelectedCategory($product->category);
    }

    public function updatedName()
    {
        $this->slug = SlugService::createSlug(Product::class, 'slug', $this->name);
    }

    public function save()
    {
        $this->validate();
        $this->product->fill(['name' => $this->name, 'slug' => $this->slug]);
        if($this->selectedCategory){
            $this->product->category_id = $this->selectedCategory->id;
        }
        if ($this->product->save()) {
            $this->emitSelf('saved');
        }
    }
}
