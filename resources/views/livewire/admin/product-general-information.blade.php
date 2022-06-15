<div>
    <form wire:submit.prevent="save" class="">
        <fieldset
            class="shadow shadow-gray-900 border border-solid rounded-lg text-gray-700 dark:text-gray-400 border-gray-300 p-3">
            <legend>
                <h3 class="bg-gray-50 text-gray-700 font-semibold dark:text-gray-400 h-9">General information:</h3>
            </legend>
            <div class="space-y-3">
                {{-- Name --}}
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    @if ($errors->has('name'))
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600  focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input
                        border-red-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            wire:model="name" placeholder="product name">
                        <span class="text-xs font-normal text-red-600 dark:text-red-400">
                            {{ $errors->first('name') }}
                        </span>
                    @else
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            wire:model="name" placeholder="product name">
                    @endif
                </label>

                {{-- Slug --}}
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Slug</span>
                    @if ($errors->has('slug'))
                        <input
                            class="disabled:bg-gray-100 block w-full mt-1 text-sm dark:border-gray-600  focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input
                        border-red-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            wire:model="slug" placeholder="product name" disabled>
                        <span class="text-xs font-normal text-red-600 dark:text-red-400">
                            {{ $errors->first('slug') }}
                        </span>
                    @else
                        <input
                            class="disabled:bg-gray-100 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            wire:model.defer="slug" placeholder="product slug" disabled>
                    @endif
                </label>
            </div>

            <hr class="my-5">
            <div>

                <p class="mt-5 font-normal text-sm text-purple-500">
                    {{ __('Please chose accordant category for your product') }}
                </p>
                <div class="grid grid-cols-3 gap-5">
                    <div>
                        <h6>Categories Level 1:</h6>
                        <select size="10" class="bg-none w-full" wire:model="selectedCategory1">
                            @foreach ($categoriesLv1 as $category)
                                <option value="{{ $category->id }}" wire:key="lv1-{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h6>Categories Level 1:</h6>
                        <select size="10" class="bg-none w-full" wire:model="selectedCategory2">
                            @foreach ($categoriesLv2 as $category)
                                <option value="{{ $category->id }}" wire:key="lv2-{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h6>Categories Level 1:</h6>
                        <select size="10" class="bg-none w-full" wire:model="selectedCategory3">
                            @foreach ($categoriesLv3 as $category)
                                <option value="{{ $category->id }}" wire:key="lv3-{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="mt-5 font-normal text-sm text-green-600 flex items-center">
                    @if ($selectedCategory?->parent?->parent)
                        {{ $selectedCategory?->parent?->parent->name }}
                        <span class="mx-1">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"></path>
                                <path
                                    d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z">
                                </path>
                            </svg>
                        </span>
                    @endif
                    @if ($selectedCategory?->parent)
                        {{ $selectedCategory?->parent->name }}
                        <span class="mx-1">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"></path>
                                <path
                                    d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z">
                                </path>
                            </svg>
                        </span>
                    @endif
                    @if ($selectedCategory)
                        {{ $selectedCategory->name }}
                    @endif
                </p>
            </div>

            <hr class="my-5">
            <x-textarea wire:model.defer="product.description" label="Product description"
                placeholder="Your product description" />
            <div class="flex justify-end items-center mt-3">
                <x-button type="submit" spinner purple label="Save" />
            </div>
        </fieldset>
    </form>
</div>
