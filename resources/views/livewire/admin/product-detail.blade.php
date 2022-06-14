<x-slot name="header">
    <div class=" pt-5">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Detail') }}
        </h2>
    </div>
</x-slot>

<div>
    <livewire:admin.product-general-information :product="$product">
</div>
