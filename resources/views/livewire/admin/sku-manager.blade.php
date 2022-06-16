<div>
    <fieldset
        class="shadow-sm shadow-gray-500 border border-solid rounded-lg text-gray-700 dark:text-gray-400 border-gray-300 p-3">
        <legend>
            <h3 class="bg-gray-50 text-gray-700 font-semibold dark:text-gray-400 h-9">SKUS:</h3>
        </legend>
        <div class="relative">
            <livewire:admin.product-sku-table :product="$product" />
        </div>
    </fieldset>
    <x-modal wire:model.defer="isShowFormForAddSkuModal">
        <x-card title="Please choose variations of the product">
            @if ($isShowFormForAddSkuModal)
                <livewire:admin.add-product-sku-table :product="$product" />
            @endif
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal wire:model.defer="isShowConfirmDeleteSkuModal">
        <x-card title="Deleting Sku: {{ $skuForDeleting?->bardcode }} (#{{$skuForDeleting?->id}})">
            <p class="text-gray-600">
                Are you sure you want to delete SKU: {{ $skuForDeleting?->bardcode }} {{' '}} (#{{$skuForDeleting?->id}})
            </p>
     
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button wire:click="delete" red label="I Agree" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
