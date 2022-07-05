<x-slot name="header">
    <div class=" pt-5">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </div>
</x-slot>

<div class="table">
    <div class="table-row">
        <label class="table-cell">Site Name:</label>
        <div class="table-cell py-1">
            <x-input placeholder="your site's name"/>
        </div>
    </div>

    <div class="table-row">
        <label class="table-cell">Site Title:</label>
        <div class="table-cell py-1">
            <x-input placeholder="your site's title"/>
        </div>
    </div>

    <div class="table-row">
        <label class="table-cell">Site Logo:</label>
        <div class="table-cell py-1">
            <x-input type="file" placeholder="your site's Logo"/>
        </div>
    </div>
</div>
