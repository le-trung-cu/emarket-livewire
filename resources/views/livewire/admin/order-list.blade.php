<x-slot name="header">
    <div class=" pt-5">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </div>
</x-slot>
<div>

    <div>

        <div class="sm:hidden relative w-11/12 mx-auto bg-white dark:bg-gray-800  rounded">
            <div class="absolute inset-0 m-auto mr-4 z-0 w-6 h-6">
                <img class="icon icon-tabler icon-tabler-selector"
                    src="https://tuk-cdn.s3.amazonaws.com/can-uploader/tabs-with-icons-svg1.svg" alt="selectors" />
            </div>
            <select aria-label="Selected tab"
                class="dark:text-white form-select block w-full p-3 border border-gray-300 rounded text-gray-600 appearance-none bg-transparent relative z-10">
                <option class="text-sm text-gray-600">inactive</option>
                <option class="text-sm text-gray-600">inactive</option>
                <option selected class="text-sm text-gray-600">Active</option>
                <option class="text-sm text-gray-600">inactive</option>
                <option class="text-sm text-gray-600">inactive</option>
            </select>
        </div>

        <div class="xl:w-full xl:mx-0 h-12 my-5 hidden sm:block bg-white dark:bg-gray-800 shadow rounded">

            <div class="flex border-b px-5 space-x-5">
                <button wire:click="$set('orderStatus', 'all')"
                    class="focus:outline-none focus:text-indigo-700 dark:focus:text-indigo-400  text-sm border-indigo-700 pt-3 rounded-t text-gray-600 hover:text-indigo-700 dark:hover:text-indigo-400  dark:text-indigo-400 cursor-pointer">
                    <div class="flex items-center mb-3">
                        <span class="ml-1 font-normal">All Orders</span>
                    </div>
                    <div @class([
                        'w-full h-1 bg-indigo-700 rounded-t-md',
                        'hidden' => $orderStatus !== 'all',
                    ])></div>
                </button>

                <button wire:click="$set('orderStatus', 'pending')"
                    class="focus:outline-none focus:text-indigo-700 dark:focus:text-indigo-400  text-sm border-indigo-700 pt-3 rounded-t text-gray-600 hover:text-indigo-700 dark:hover:text-indigo-400  dark:text-indigo-400 cursor-pointer">
                    <div class="flex items-center mb-3">
                        <span class="ml-1 font-normal">Continuing</span>
                    </div>
                    <div @class([
                        'w-full h-1 bg-indigo-700 rounded-t-md',
                        'hidden' => $orderStatus !== 'pending',
                    ])></div>
                </button>
                <button wire:click="$set('orderStatus', 'registered')"
                    class="focus:outline-none focus:text-indigo-700 dark:focus:text-indigo-400  text-sm border-indigo-700 pt-3 rounded-t text-gray-600 hover:text-indigo-700 dark:hover:text-indigo-400  dark:text-indigo-400 cursor-pointer">
                    <div class="flex items-center mb-3">
                        <span class="ml-1 font-normal">Restitute</span>
                    </div>
                    <div @class([
                        'w-full h-1 bg-indigo-700 rounded-t-md',
                        'hidden' => $orderStatus !== 'restitute',
                    ])></div>
                </button>
                <button wire:click="$set('orderStatus', 'packing')"
                    class="focus:outline-none focus:text-indigo-700 dark:focus:text-indigo-400  text-sm border-indigo-700 pt-3 rounded-t text-gray-600 hover:text-indigo-700 dark:hover:text-indigo-400  dark:text-indigo-400 cursor-pointer">
                    <div class="flex items-center mb-3">
                        <span class="ml-1 font-normal">Packing</span>
                    </div>
                    <div @class([
                        'w-full h-1 bg-indigo-700 rounded-t-md',
                        'hidden' => $orderStatus !== 'packing',
                    ])></div>
                </button>

                <button wire:click="$set('orderStatus', 'sent')"
                    class="focus:outline-none focus:text-indigo-700 dark:focus:text-indigo-400  text-sm border-indigo-700 pt-3 rounded-t text-gray-600 hover:text-indigo-700 dark:hover:text-indigo-400  dark:text-indigo-400 cursor-pointer">
                    <div class="flex items-center mb-3">
                        <span class="ml-1 font-normal">Sent</span>
                    </div>
                    <div @class([
                        'w-full h-1 bg-indigo-700 rounded-t-md',
                        'hidden' => $orderStatus !== 'sent',
                    ])></div>
                </button>

                <button wire:click="$set('orderStatus', 'complated')"
                    class="focus:outline-none focus:text-indigo-700 dark:focus:text-indigo-400  text-sm border-indigo-700 pt-3 rounded-t text-gray-600 hover:text-indigo-700 dark:hover:text-indigo-400  dark:text-indigo-400 cursor-pointer">
                    <div class="flex items-center mb-3">
                        <span class="ml-1 font-normal">Complated</span>
                    </div>
                    <div @class([
                        'w-full h-1 bg-indigo-700 rounded-t-md',
                        'hidden' => $orderStatus !== 'complated',
                    ])></div>
                </button>

                <button wire:click="$set('orderStatus', 'canceled')"
                    class="focus:outline-none focus:text-indigo-700 dark:focus:text-indigo-400  text-sm border-indigo-700 pt-3 rounded-t text-gray-600 hover:text-indigo-700 dark:hover:text-indigo-400  dark:text-indigo-400 cursor-pointer">
                    <div class="flex items-center mb-3">
                        <span class="ml-1 font-normal">Canceled</span>
                    </div>
                    <div @class([
                        'w-full h-1 bg-indigo-700 rounded-t-md',
                        'hidden' => $orderStatus !== 'canceled',
                    ])></div>
                </button>
            </div>
        </div>
    </div>

    <livewire:admin.order-table :orderStatus="$orderStatus" wire:key="table-{{ $orderStatus }}" />

    <x-modal wire:model.defer="isShowPrintOrderModal">
        <x-card title="Please choose size to print ">
            <div class="flex space-x-3">
                <x-button href="https://dev-online-gateway.ghn.vn/a5/public-api/printA5?token={{ $printOrderToken }}"
                    target="_blank" rounded secondary label="print A5" />
                <x-button href="https://dev-online-gateway.ghn.vn/a5/public-api/print80x80?token={{ $printOrderToken }}"
                    target="_blank" rounded secondary label="print 80x80" />
                <x-button href="https://dev-online-gateway.ghn.vn/a5/public-api/print52x70?token={{ $printOrderToken }}"
                    target="_blank" rounded secondary label="print 53x70" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
