<x-slot name="header">
    <div class=" pt-5">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </div>
</x-slot>

<form wire:submit.prevent="save" class=" max-w-3xl m-auto">
    <div class="table">
        <div class="table-row">
            <label class="table-cell px-5">Site Name:</label>
            <div class="table-cell py-1">
                <x-input placeholder="your site's name" wire:model.defer="siteName" />
            </div>
        </div>

        <div class="table-row">
            <label class="table-cell px-5">Site Title:</label>
            <div class="table-cell py-1">
                <x-input placeholder="your site's title" wire:model.defer="siteTitle"/>
            </div>
        </div>

        <div class="table-row">
            <label class="table-cell px-5">Site Logo:</label>
            <div class="table-cell py-1">
                <x-input type="file" placeholder="your site's Logo" />
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <x-button type="submit" spinner purple label="Save" />
    </div>
</form>
