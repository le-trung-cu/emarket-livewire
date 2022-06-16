<div>

    <fieldset
        class="shadow-sm shadow-gray-500 border border-solid rounded-lg text-gray-700 dark:text-gray-400 border-gray-300 p-3">
        <legend>
            <h3 class="flex items-baseline bg-gray-50 text-gray-700 font-semibold dark:text-gray-400 h-9">Variation options:
                <x-button.circle class="ml-2" xs primary label="+" title="Add variation option"
                    wire:click="showFormForCreationModal" />
            </h3>
        </legend>
        {{-- Variation Option Values --}}
        <div class="space-y-3">
            @foreach ($product->variationOptions as $option)
                <livewire:admin.variation-value-manager wire:key="variation-option-{{ $option->id }}"
                    :option="$option" />
            @endforeach
        </div>
        {{-- Create Variation Option Form --}}
        <form wire:submit.prevent="create" class="grid auto-cols-min auto-rows-min items-center">
            <x-modal wire:model.defer="isShowFormForCreationModal">
                <x-card title="Create variation option">
                    <x-input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        label="Name" placeholder="Varition option name" wire:model.defer="optionForCreation.name" />
                    <x-native-select
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        label="Visual" placeholder="Select one status" :options="['text', 'color']"
                        wire:model.defer="optionForCreation.visual" />
                    <x-slot name="footer">
                        <div class="flex justify-end gap-x-4">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button type="submit" spinner purple label="Create" />
                        </div>
                    </x-slot>
                </x-card>
            </x-modal>
        </form>

        {{-- Comfirm delete Variation option --}}
        <x-modal wire:model.defer="isShowConfirmDeleteModal">
            <x-card title="Delete vatiation option: {{ $optionForDeleting?->name }}">
                <p class="text-red-600 bg-red-100 p-2 rounded-sm font-bold text-sm">
                    are you sure you want to delete variation option: <span
                        class="text-red-900">{{ $optionForDeleting?->name }}</span>
                </p>
    
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button wire:click="delete" red label="I Agree Delete" />
                    </div>
                </x-slot>
            </x-card>
        </x-modal>
    </fieldset>

</div>
