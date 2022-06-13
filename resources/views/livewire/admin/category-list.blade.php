<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Categories') }}
    </h2>
</x-slot>
<div class="grid grid-cols-3 gap-5">
    <div>
        <h3 class="font-semibold my-5">Categories level 1:</h3>
        <div>
            @foreach ($categoriesLv1 as $category)
                <livewire:admin.editable-category
                    wire:key="lv1-category-id-{{ $category->id }}-selected-id-{{ $selectedCategory1 ?? 0 }}"
                    :category="$category" :level="1" :selectedId="$selectedCategory1" />
            @endforeach
        </div>

    </div>
    <div>
        <h3 class="font-semibold my-5">Categories level 2:</h3>
        @foreach ($categoriesLv2 as $category)
            <livewire:admin.editable-category
                wire:key="lv2-category-id-{{ $category->id }}-selected-id-{{ $selectedCategory2 ?? 0 }}"
                :category="$category" :level="2" :selectedId="$selectedCategory2" />
        @endforeach
    </div>
    <div>
        <h3 class="font-semibold my-5">Categories level 3:</h3>
        @foreach ($categoriesLv3 as $category)
            <livewire:admin.editable-category
                wire:key="lv3-category-id-{{ $category->id }}-selected-id-{{ $selectedCategory3 ?? 0 }}"
                :category="$category" :level="3" :selectedId="$selectedCategory3" />
        @endforeach
    </div>
    <x-modal wire:model.defer="confirmDeleteCategoryModal">
        <x-card title="Delete category: {{ $categoryForDeleting?->name }}">
            <p class="text-red-600 bg-red-100 p-2 rounded-sm font-bold text-sm">
                are you sure you want to delete category: <span class="text-red-900">{{ $categoryForDeleting?->name }}</span>
            </p>
    
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button wire:click="delete({{$categoryForDeleting?->id}})" red label="I Agree Delete" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
</div>
