<div>
    <fieldset class="border border-solid rounded-lg text-gray-700 dark:text-gray-400 border-gray-300 p-3"
        x-data="{ openAddVariationValueForm: false }">
        <legend class="flex text-gray-700 dark:text-gray-400">
            <button title="delete" class="mr-2 text-red-600" wire:click="$emitUp('showConfirmDeleteModal', {{$option->id}})">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor">
                    <defs></defs>
                    <title>trash-can</title>
                    <rect x="12" y="12" width="2" height="12"></rect>
                    <rect x="18" y="12" width="2" height="12"></rect>
                    <path d="M4,6V8H6V28a2,2,0,0,0,2,2H24a2,2,0,0,0,2-2V8h2V6ZM8,28V8H24V28Z"></path>
                    <rect x="12" y="2" width="8" height="2"></rect>
                    <rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1"
                        width="32" height="32" style="fill:none"></rect>
                </svg>
            </button>
            {{ $option->name }}
        </legend>
        <div class="flex flex-wrap space-x-2 items-center">
            @if ($option->visual === 'text')
                @foreach ($option->values as $variationValue)
                    <div wire:key="variation-text-{{$variationValue->id}}"
                        class="group relative px-3 m-1 py-1 text-sm font-medium leading-5 text-gray-800 dark:text-gray-300 transition-colors duration-150 border-purple-300 border-2 rounded-md focus:outline-none focus:shadow-outline-purple">
                        <span>{{ $variationValue->value }}</span>
                        <x-button.circle class="group-hover:visible invisible absolute -top-2 -right-2" 2xs negative
                        wire:click="$emitSelf('comfirmDeleteVariation',{{$variationValue->id}})"
                            icon="x" />
                    </div>
                @endforeach
            @elseif ($option->visual === 'color')
                @foreach ($option->values as $variationValue)
                    <div wire:key="variation-color-{{$variationValue->id}}" class="group relative" title="{{ $variationValue->label }}"
                        style="background-color: {{ $variationValue->value }}"
                        class="h-8 w-8 rounded-full px-3 m-1 text-sm font-medium leading-5 duration-150 border-2 focus:outline-none focus:shadow-outline-purple">
                        <x-button.circle class="group-hover:visible invisible absolute -top-2 -right-2" 2xs negative
                            icon="x" />
                    </div>
                @endforeach
            @endif
            <x-button.circle x-on:click="openAddVariationValueForm = !openAddVariationValueForm" class="ml-10" primary 2xs label="+" />
        </div>

        <form x-show="openAddVariationValueForm" wire:submit.prevent="create">
            <div class="grid auto-cols-auto auto-rows-auto gap-x-5">
                <label class="text-sm col-start-1">
                    <span class="text-gray-700 dark:text-gray-400">Value</span>
                </label>
                <input
                    class="col-start-1 row-start-2 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    wire:model.defer="variationValue.value">
                <span class="col-start-1 row-start-3 text-xs font-normal text-red-600 dark:text-red-400">
                    @error('variationValue.value')
                        {{ $message }}
                    @enderror
                </span>

                <label class="col-start-2 row-start-1 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Label</span>
                </label>
                <input
                    class="col-start-2 row-start-2 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    wire:model.defer="variationValue.label">
                <span class="col-start-2 row-start-3 text-xs font-normal text-red-600 dark:text-red-400">
                    @error('variationValue.label')
                        {{ $message }}
                    @enderror
                </span>
                <x-button class="col-start-3 row-start-2 w-16" type="submit" spinner purple label="Save" />
            </div>
        </form>
    </fieldset>

    <x-modal wire:model.defer="showConfirmDeleteVariationModal">
        <x-card title="Delete variation value: {{ $variationForDeleting?->name }}">
            <p class="text-red-600 bg-red-100 p-2 rounded-sm font-bold text-sm">
                are you sure you want to delete variation value: <span
                    class="text-red-900">{{ $variationForDeleting?->name }}</span>
            </p>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button wire:click="delete" red label="I Agree Delete" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
