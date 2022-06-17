<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductMediaManager extends Component
{
    use WithFileUploads;

    public Product $product;

    public $photos = [];
    public $thumbnail = null;

    protected $rules = [
        'photos.*' => 'nullable|image|max:1024', // 1MB Max,
        'thumbnail' => 'nullable|image|max:1024',
    ];

    protected $listeners = ['admin.product-media-refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.admin.product-media-manager');
    }

    public function save()
    {

        $this->validate();

        if ($this->thumbnail) {
            $media = $this->product->addMedia($this->thumbnail)->toMediaCollection('product-thumbnail');
            $this->product->update([
                'thumbnail' => $media->getFullUrl(),
            ]);
        }
        $medias = $this->product->getMedia('product-galary');
        $mediaForDeleting = [];
        foreach ($this->photos as $key => $photo) {
            if($medias->has($key)){
                $mediaForDeleting[] = $medias->get($key);
            }

            $this
                ->product
                ->addMedia($photo)
                ->toMediaCollection('product-galary');
        }

        foreach ($mediaForDeleting as $media) {
            $media->delete();
        }


        $this->photos = [];
        $this->thumbnail = null;
        $this->emitSelf('admin.product-media-refresh');
    }

    public function delete(Media $media)
    {
        $media->delete();
        $this->emitSelf('admin.product-media-refresh');
    }
}
