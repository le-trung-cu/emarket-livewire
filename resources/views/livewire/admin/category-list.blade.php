<x-slot name="header">
    <div class=" pt-5">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </div>
</x-slot>
<div class="grid grid-cols-3 gap-5">
    <div>
        @if (!collect($categoriesLv1)->isEmpty())
            <h3 class="font-semibold my-5">Categories level 1:</h3>
            <ul wire:sortable="updateCategoryOrder">
                @foreach ($categoriesLv1 as $category)
                    <li wire:sortable.item="{{ $category->id }}" wire:key="category-{{ $category->id }}"
                        class="flex items-center">
                        <button wire:sortable.handle type="button"
                            class="cursor-move text-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"
                                fill="currentColor">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 4.625C6.12132 4.625 6.625 4.12132 6.625 3.5C6.625 2.87868 6.12132 2.375 5.5 2.375C4.87868 2.375 4.375 2.87868 4.375 3.5C4.375 4.12132 4.87868 4.625 5.5 4.625ZM9.5 4.625C10.1213 4.625 10.625 4.12132 10.625 3.5C10.625 2.87868 10.1213 2.375 9.5 2.375C8.87868 2.375 8.375 2.87868 8.375 3.5C8.375 4.12132 8.87868 4.625 9.5 4.625ZM10.625 7.5C10.625 8.12132 10.1213 8.625 9.5 8.625C8.87868 8.625 8.375 8.12132 8.375 7.5C8.375 6.87868 8.87868 6.375 9.5 6.375C10.1213 6.375 10.625 6.87868 10.625 7.5ZM5.5 8.625C6.12132 8.625 6.625 8.12132 6.625 7.5C6.625 6.87868 6.12132 6.375 5.5 6.375C4.87868 6.375 4.375 6.87868 4.375 7.5C4.375 8.12132 4.87868 8.625 5.5 8.625ZM10.625 11.5C10.625 12.1213 10.1213 12.625 9.5 12.625C8.87868 12.625 8.375 12.1213 8.375 11.5C8.375 10.8787 8.87868 10.375 9.5 10.375C10.1213 10.375 10.625 10.8787 10.625 11.5ZM5.5 12.625C6.12132 12.625 6.625 12.1213 6.625 11.5C6.625 10.8787 6.12132 10.375 5.5 10.375C4.87868 10.375 4.375 10.8787 4.375 11.5C4.375 12.1213 4.87868 12.625 5.5 12.625Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                        <livewire:admin.editable-category
                            wire:key="lv1-category-id-{{ $category->id }}-selected-id-{{ $selectedCategory1 ?? 0 }}"
                            :category="$category" :level="1" :selectedId="$selectedCategory1" />
                    </li>
                @endforeach
            </ul>
        @endif


    </div>
    <div>
        <div>
            @if (!collect($categoriesLv2)->isEmpty())
                <h3 class="font-semibold my-5">Categories level 2:</h3>
                <ul wire:sortable="updateCategoryOrder">
                    @foreach ($categoriesLv2 as $category)
                        <li wire:sortable.item="{{ $category->id }}" wire:key="category-{{ $category->id }}"
                            class="flex items-center">
                            <button wire:sortable.handle
                                class="text-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.5 4.625C6.12132 4.625 6.625 4.12132 6.625 3.5C6.625 2.87868 6.12132 2.375 5.5 2.375C4.87868 2.375 4.375 2.87868 4.375 3.5C4.375 4.12132 4.87868 4.625 5.5 4.625ZM9.5 4.625C10.1213 4.625 10.625 4.12132 10.625 3.5C10.625 2.87868 10.1213 2.375 9.5 2.375C8.87868 2.375 8.375 2.87868 8.375 3.5C8.375 4.12132 8.87868 4.625 9.5 4.625ZM10.625 7.5C10.625 8.12132 10.1213 8.625 9.5 8.625C8.87868 8.625 8.375 8.12132 8.375 7.5C8.375 6.87868 8.87868 6.375 9.5 6.375C10.1213 6.375 10.625 6.87868 10.625 7.5ZM5.5 8.625C6.12132 8.625 6.625 8.12132 6.625 7.5C6.625 6.87868 6.12132 6.375 5.5 6.375C4.87868 6.375 4.375 6.87868 4.375 7.5C4.375 8.12132 4.87868 8.625 5.5 8.625ZM10.625 11.5C10.625 12.1213 10.1213 12.625 9.5 12.625C8.87868 12.625 8.375 12.1213 8.375 11.5C8.375 10.8787 8.87868 10.375 9.5 10.375C10.1213 10.375 10.625 10.8787 10.625 11.5ZM5.5 12.625C6.12132 12.625 6.625 12.1213 6.625 11.5C6.625 10.8787 6.12132 10.375 5.5 10.375C4.87868 10.375 4.375 10.8787 4.375 11.5C4.375 12.1213 4.87868 12.625 5.5 12.625Z"
                                        fill="currentColor"></path>
                                </svg>
                            </button>
                            <livewire:admin.editable-category
                                wire:key="lv2-category-id-{{ $category->id }}-selected-id-{{ $selectedCategory2 ?? 0 }}"
                                :category="$category" :level="2" :selectedId="$selectedCategory2" />
                        </li>
                    @endforeach
                </ul>
            @endif


        </div>

    </div>
    <div>
        @if (!collect($categoriesLv3)->isEmpty())
            <h3 class="font-semibold my-5">Categories level 3:</h3>
            <ul wire:sortable="updateCategoryOrder">
                @foreach ($categoriesLv3 as $category)
                    <li wire:sortable.item="{{ $category->id }}" wire:key="category-{{ $category->id }}"
                        class="flex items-center">
                        <button wire:sortable.handle type="button"
                            class="text-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"
                                fill="currentColor">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 4.625C6.12132 4.625 6.625 4.12132 6.625 3.5C6.625 2.87868 6.12132 2.375 5.5 2.375C4.87868 2.375 4.375 2.87868 4.375 3.5C4.375 4.12132 4.87868 4.625 5.5 4.625ZM9.5 4.625C10.1213 4.625 10.625 4.12132 10.625 3.5C10.625 2.87868 10.1213 2.375 9.5 2.375C8.87868 2.375 8.375 2.87868 8.375 3.5C8.375 4.12132 8.87868 4.625 9.5 4.625ZM10.625 7.5C10.625 8.12132 10.1213 8.625 9.5 8.625C8.87868 8.625 8.375 8.12132 8.375 7.5C8.375 6.87868 8.87868 6.375 9.5 6.375C10.1213 6.375 10.625 6.87868 10.625 7.5ZM5.5 8.625C6.12132 8.625 6.625 8.12132 6.625 7.5C6.625 6.87868 6.12132 6.375 5.5 6.375C4.87868 6.375 4.375 6.87868 4.375 7.5C4.375 8.12132 4.87868 8.625 5.5 8.625ZM10.625 11.5C10.625 12.1213 10.1213 12.625 9.5 12.625C8.87868 12.625 8.375 12.1213 8.375 11.5C8.375 10.8787 8.87868 10.375 9.5 10.375C10.1213 10.375 10.625 10.8787 10.625 11.5ZM5.5 12.625C6.12132 12.625 6.625 12.1213 6.625 11.5C6.625 10.8787 6.12132 10.375 5.5 10.375C4.87868 10.375 4.375 10.8787 4.375 11.5C4.375 12.1213 4.87868 12.625 5.5 12.625Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                        <livewire:admin.editable-category
                            wire:key="lv3-category-id-{{ $category->id }}-selected-id-{{ $selectedCategory3 ?? 0 }}"
                            :category="$category" :level="3" :selectedId="$selectedCategory3" />
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <x-modal wire:model.defer="confirmDeleteCategoryModal">
        <x-card title="Delete category: {{ $categoryForDeleting?->name }}">
            <p class="text-red-600 bg-red-100 p-2 rounded-sm font-bold text-sm">
                are you sure you want to delete category: <span
                    class="text-red-900">{{ $categoryForDeleting?->name }}</span>
            </p>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button wire:click="delete({{ $categoryForDeleting?->id }})" red label="I Agree Delete" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
