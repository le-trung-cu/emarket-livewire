<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full w-full sm:px-6 lg:px-8">

        <div>
            <div class="md:flex md:flex-row w-full justify-between items-center">
                <div class="md:flex md:flex-row w-full">
                    <div>
                        <div class="w-full md:w-auto">
                            <div class="sm:flex sm:flex-row">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center items-center text-sm">
                        <div class="mr-2 mt-2 sm:mt-0">
                            <div x-data="{ open: false }" @click.away="open = false">
                                <button @click.prevent="open = ! open"
                                    class="block bg-slate-50 text-slate-700 border border-slate-300 rounded py-1.5 px-3 leading-tight
               focus:outline-none focus:bg-white focus:border-slate-600 dark:border-slate-500 dark:bg-slate-700
               2xl:dark:placeholder-slate-300 dark:text-slate-300">
                                    <div class="flex">
                                        <svg class="h-6 w-6 text-slate-500 dark:text-slate-300" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>

                                    </div>
                                </button>

                                <div x-show="open" x-transition:enter="transform duration-200"
                                    x-transition:enter-start="opacity-0 scale-90"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transform duration-200"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-90"
                                    class="mt-2 w-auto bg-white shadow-xl absolute z-10 dark:bg-slate-600"
                                    style="display: none;">

                                    <div class="flex px-4 py-2 text-slate-400 dark:text-slate-300">
                                        <span class="w-12">Excel</span>
                                        <a x-on:click="$wire.call('exportToXLS'); open = false" href="#"
                                            class="px-2 block text-slate-800 hover:bg-slate-50 hover:text-black-300 dark:text-slate-200 dark:hover:bg-slate-700 rounded">
                                            All </a>
                                        <a x-on:click="$wire.call('exportToXLS', true); open = false" href="#"
                                            class="px-2 block text-slate-800 hover:bg-slate-50 hover:text-black-300 dark:text-slate-200 dark:hover:bg-slate-700 rounded">
                                            Selected </a>
                                    </div>
                                    <div class="flex px-4 py-2 text-slate-400 dark:text-slate-300">
                                        <span class="w-12">Csv</span>
                                        <a x-on:click="$wire.call('exportToCsv'); open = false" href="#"
                                            class="px-2 block text-slate-800 hover:bg-slate-50 hover:text-black-300 dark:text-slate-200 dark:hover:bg-slate-700 rounded">
                                            All </a>
                                        <a x-on:click="$wire.call('exportToCsv', true); open = false" href="#"
                                            class="px-2 block text-slate-800 hover:bg-slate-50 hover:text-black-300 dark:text-slate-200 dark:hover:bg-slate-700 rounded">
                                            Selected </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }" class="mr-0 sm:mr-2 mt-2 sm:mt-0" @click.away="open = false">
                            <button @click.prevent="open = ! open"
                                class="block bg-slate-50 text-slate-700 border border-slate-300 rounded py-1.5 px-3 leading-tight
                   focus:outline-none focus:bg-white focus:border-slate-600 dark:border-slate-500 dark:bg-slate-700
                   2xl:dark:placeholder-slate-300 dark:text-slate-200 dark:text-slate-300">
                                <div class="flex">
                                    <svg class="h-6 w-6 text-slate-500 dark:text-slate-300"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                        </path>
                                    </svg>

                                </div>
                            </button>

                            <div x-show="open" x-transition:enter="transform duration-200"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transform duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-90"
                                class="mt-2 py-2 w-48 bg-white shadow-xl absolute z-10 dark:bg-slate-600"
                                style="display: none;">

                                <div wire:click="$emit('pg:toggleColumn-default', 'id')" wire:key="toggle-column-id"
                                    class=" cursor-pointer flex justify-start block px-4 py-2 text-slate-800 hover:bg-slate-50 hover:text-black-200 dark:text-slate-200 dark:hover:bg-gray-900 dark:hover:bg-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-slate-500 dark:text-slate-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <div class="ml-2">
                                        ID
                                    </div>
                                </div>
                                <div wire:click="$emit('pg:toggleColumn-default', 'name')" wire:key="toggle-column-name"
                                    class=" cursor-pointer flex justify-start block px-4 py-2 text-slate-800 hover:bg-slate-50 hover:text-black-200 dark:text-slate-200 dark:hover:bg-gray-900 dark:hover:bg-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-slate-500 dark:text-slate-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <div class="ml-2">
                                        NAME
                                    </div>
                                </div>
                                <div wire:click="$emit('pg:toggleColumn-default', 'thumbnail')"
                                    wire:key="toggle-column-thumbnail"
                                    class=" cursor-pointer flex justify-start block px-4 py-2 text-slate-800 hover:bg-slate-50 hover:text-black-200 dark:text-slate-200 dark:hover:bg-gray-900 dark:hover:bg-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-slate-500 dark:text-slate-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <div class="ml-2">
                                        THUMBNAIL
                                    </div>
                                </div>
                                <div wire:click="$emit('pg:toggleColumn-default', 'regular_price')"
                                    wire:key="toggle-column-regular_price"
                                    class=" cursor-pointer flex justify-start block px-4 py-2 text-slate-800 hover:bg-slate-50 hover:text-black-200 dark:text-slate-200 dark:hover:bg-gray-900 dark:hover:bg-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-slate-500 dark:text-slate-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <div class="ml-2">
                                        REGULAR PRICE
                                    </div>
                                </div>
                                <div wire:click="$emit('pg:toggleColumn-default', 'skus')"
                                    wire:key="toggle-column-skus"
                                    class=" cursor-pointer flex justify-start block px-4 py-2 text-slate-800 hover:bg-slate-50 hover:text-black-200 dark:text-slate-200 dark:hover:bg-gray-900 dark:hover:bg-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-slate-500 dark:text-slate-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <div class="ml-2">
                                        SKUS
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:loading="" class="mt-2">
                        <div class="loader ease-linear rounded-full border-2 border-t-2 border-slate-200 h-6 w-6">
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-row mt-2 md:mt-0 w-full rounded-full flex justify-start sm:justify-center md:justify-end">
                    <div class="relative rounded-full w-full md:w-4/12 float-end float-right md:w-full lg:w-1/2">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-1">
                            <span class="p-1 focus:outline-none focus:shadow-outline">
                                <svg class="h-6 w-6 text-slate-300 dark:text-slate-200" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>

                            </span>
                        </span>
                        <input wire:model.debounce.600ms="search" type="text"
                            style="padding-left: 36px !important;"
                            class="placeholder-slate-400 block w-full float-right bg-white text-slate-700 border border-slate-300 rounded-full py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-slate-500 pl-10 dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500"
                            placeholder="Search...">
                    </div>
                </div>
            </div>


        </div>




        <div class="my-3 overflow-x-auto bg-white shadow-lg rounded-lg overflow-y-auto relative" style="">
            <div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <table
                    class="table power-grid-table rounded-lg min-w-full border border-slate-200 dark:bg-slate-600 dark:border-slate-500"
                    style="">
                    <thead
                        class="shadow-sm bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-500"
                        style="">
                        <tr class="" style="">

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="" wire:key="6547d51e9e434565ea44367ab89a0beb">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:click="selectCheckboxAll()"
                                            wire:model.defer="checkboxAll">
                                    </label>
                                </div>
                            </th>


                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="b80bb7740288fda1f201890375a60c8f" style="; width: max-content;   ">
                                <div class="">
                                    <span>ID</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="b068931cc450442b63f5b3d276ea4297"
                                style="; width: max-content;  cursor:pointer;   ">
                                <div class="" wire:click="sortBy('name')">
                                    <span class="text-md pr-2">
                                        ↕
                                    </span>
                                    <span>NAME</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="2dbcba41b9ac4c5d22886ba672463cb4"
                                style="display:none; width: max-content;  cursor:pointer;   ">
                                <div class="" wire:click="sortBy('slug')">
                                    <span class="text-md pr-2">
                                        ↕
                                    </span>
                                    <span>SLUG</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="951d4dff3c22e9fcc4a2707009f45ea8" style="; width: max-content;   ">
                                <div class="">
                                    <span>THUMBNAIL</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="74940e04dccf401997f3c7c9a4d2b0ba"
                                style="; width: max-content;  cursor:pointer;   ">
                                <div class="" wire:click="sortBy('regular_price')">
                                    <span class="text-md pr-2">
                                        ↕
                                    </span>
                                    <span>REGULAR PRICE</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="fe482f0de39cc2d3bd41c6f858f326f3"
                                style="display:none; width: max-content;   ">
                                <div class="">
                                    <span>STORE BRANCH ID</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="b583a6293fe1d5750ba17314e10419cc"
                                style="display:none; width: max-content;   ">
                                <div class="">
                                    <span>CATEGORY ID</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="85e01879c3fa5cb5c733bbfd7807e9a1" style="; width: max-content;   ">
                                <div class="">
                                    <span>SKUS</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="9792e58c67cd3053570319d6e8bdaea8"
                                style="display:none; width: max-content;  cursor:pointer;   ">
                                <div class="" wire:click="sortBy('created_at')">
                                    <span class="text-md pr-2">
                                        ↕
                                    </span>
                                    <span>CREATED AT</span>
                                </div>
                            </th>
                            <th class="font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-slate-700 tracking-wider whitespace-nowrap dark:text-slate-300 "
                                wire:key="666b800223d18e41f999fb778095816c"
                                style="display:none; width: max-content;  cursor:pointer;   ">
                                <div class="" wire:click="sortBy('updated_at')">
                                    <span class="text-md pr-2">
                                        ↕
                                    </span>
                                    <span>UPDATED AT</span>
                                </div>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="text-slate-800" style="">
                        <tr class=" bg-white shadow-sm dark:bg-slate-700" style=" ">
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style=""></td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="; ">
                                <div>
                                    <div class="">
                                        <div class="flex flex-col">
                                            <div class="">
                                                <input wire:model.debounce.800ms="filters.number.id.start"
                                                    wire:input.debounce.800ms="filterNumberStart('id', $event.target.value, 'ID')"
                                                    style=" " type="text"
                                                    class="power_grid block bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 min-w-[5rem] "
                                                    placeholder="Min">
                                            </div>
                                            <div class="mt-1">
                                                <input wire:model.debounce.800ms="filters.number.id.end"
                                                    wire:input.debounce.800ms="filterNumberEnd('id',$event.target.value, 'ID')"
                                                    style=" " type="text"
                                                    class="power_grid block bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 min-w-[5rem] "
                                                    placeholder="Max">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="; ">
                                <div>
                                    <div class="min-w-[9.5rem]" style="">
                                        <div class="flex flex-col">
                                            <div class="">
                                                <div class="relative">
                                                    <select
                                                        class="power_grid appearance-none block bg-white border border-slate-300 text-slate-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 "
                                                        style=""
                                                        wire:model.lazy="filters.input_text_options.name"
                                                        wire:input.lazy="filterInputTextOptions('name', $event.target.value, 'NAME')">
                                                        <option value="contains">Contains</option>
                                                        <option value="contains_not">Does not contain</option>
                                                        <option value="is">Is</option>
                                                        <option value="is_not">Is not</option>
                                                        <option value="starts_with">Starts with</option>
                                                        <option value="ends_with">Ends with</option>
                                                        <option value="is_empty">Is empty</option>
                                                        <option value="is_not_empty">Is not empty</option>
                                                        <option value="is_null">Is null</option>
                                                        <option value="is_not_null">Is not null</option>
                                                        <option value="is_blank">Is blank</option>
                                                        <option value="is_not_blank">Is not blank</option>
                                                    </select>
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                                        <svg class="pointer-events-none w-4 h-4 dark:text-gray-300"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <input data-id="name"
                                                    wire:model.debounce.800ms="filters.input_text.name"
                                                    wire:input.debounce.800ms="filterInputText('name', $event.target.value, 'NAME')"
                                                    type="text"
                                                    class="power_grid w-full block bg-white text-slate-700 border border-slate-300 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-slate-500 dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500"
                                                    placeholder="NAME">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="display:none; ">
                                <div>
                                    <div class="min-w-[9.5rem]" style="">
                                        <div class="flex flex-col">
                                            <div class="">
                                                <div class="relative">
                                                    <select
                                                        class="power_grid appearance-none block bg-white border border-slate-300 text-slate-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 "
                                                        style=""
                                                        wire:model.lazy="filters.input_text_options.slug"
                                                        wire:input.lazy="filterInputTextOptions('slug', $event.target.value, 'SLUG')">
                                                        <option value="contains">Contains</option>
                                                        <option value="contains_not">Does not contain</option>
                                                        <option value="is">Is</option>
                                                        <option value="is_not">Is not</option>
                                                        <option value="starts_with">Starts with</option>
                                                        <option value="ends_with">Ends with</option>
                                                        <option value="is_empty">Is empty</option>
                                                        <option value="is_not_empty">Is not empty</option>
                                                        <option value="is_null">Is null</option>
                                                        <option value="is_not_null">Is not null</option>
                                                        <option value="is_blank">Is blank</option>
                                                        <option value="is_not_blank">Is not blank</option>
                                                    </select>
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                                        <svg class="pointer-events-none w-4 h-4 dark:text-gray-300"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <input data-id="slug"
                                                    wire:model.debounce.800ms="filters.input_text.slug"
                                                    wire:input.debounce.800ms="filterInputText('slug', $event.target.value, 'SLUG')"
                                                    type="text"
                                                    class="power_grid w-full block bg-white text-slate-700 border border-slate-300 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-slate-500 dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500"
                                                    placeholder="SLUG">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="; ">
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="; ">
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="display:none; ">
                                <div>
                                    <div class="">
                                        <div class="flex flex-col">
                                            <div class="">
                                                <input wire:model.debounce.800ms="filters.number.store_branch_id.start"
                                                    wire:input.debounce.800ms="filterNumberStart('store_branch_id', $event.target.value, 'STORE BRANCH ID')"
                                                    style=" " type="text"
                                                    class="power_grid block bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 min-w-[5rem] "
                                                    placeholder="Min">
                                            </div>
                                            <div class="mt-1">
                                                <input wire:model.debounce.800ms="filters.number.store_branch_id.end"
                                                    wire:input.debounce.800ms="filterNumberEnd('store_branch_id',$event.target.value, 'STORE BRANCH ID')"
                                                    style=" " type="text"
                                                    class="power_grid block bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 min-w-[5rem] "
                                                    placeholder="Max">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="display:none; ">
                                <div>
                                    <div class="">
                                        <div class="flex flex-col">
                                            <div class="">
                                                <input wire:model.debounce.800ms="filters.number.category_id.start"
                                                    wire:input.debounce.800ms="filterNumberStart('category_id', $event.target.value, 'CATEGORY ID')"
                                                    style=" " type="text"
                                                    class="power_grid block bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 min-w-[5rem] "
                                                    placeholder="Min">
                                            </div>
                                            <div class="mt-1">
                                                <input wire:model.debounce.800ms="filters.number.category_id.end"
                                                    wire:input.debounce.800ms="filterNumberEnd('category_id',$event.target.value, 'CATEGORY ID')"
                                                    style=" " type="text"
                                                    class="power_grid block bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500 min-w-[5rem] "
                                                    placeholder="Max">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="; ">
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="display:none; ">
                                <div wire:ignore="" x-data="pgFlatPickr({
                                    dataField: 'created_at',
                                    tableName: 'default',
                                    filterKey: 'enabledFilters.date_picker.created_at',
                                    label: 'CREATED AT',
                                    locale: null,
                                    onlyFuture: false,
                                    noWeekEnds: false,
                                    customConfig: []
                                })">
                                    <div class="p-2" style="">
                                        <form autocomplete="off">
                                            <input id="input_created_at_formatted" x-ref="rangeInput"
                                                autocomplete="off" data-field="created_at" style="min-width: 12rem "
                                                class="power_grid flatpickr flatpickr-input block my-1 bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500"
                                                type="text" readonly="readonly" placeholder="Select a period"
                                                wire:model="filters.input_date_picker.created_at">
                                        </form>
                                    </div>
                                </div>

                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200" style="display:none; ">
                                <div wire:ignore="" x-data="pgFlatPickr({
                                    dataField: 'updated_at',
                                    tableName: 'default',
                                    filterKey: 'enabledFilters.date_picker.updated_at',
                                    label: 'UPDATED AT',
                                    locale: null,
                                    onlyFuture: false,
                                    noWeekEnds: false,
                                    customConfig: []
                                })">
                                    <div class="p-2" style="">
                                        <form autocomplete="off">
                                            <input id="input_updated_at_formatted" x-ref="rangeInput"
                                                autocomplete="off" data-field="updated_at" style="min-width: 12rem "
                                                class="power_grid flatpickr flatpickr-input block my-1 bg-white border border-slate-300 text-slate-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500 w-full active dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500"
                                                type="text" readonly="readonly" placeholder="Select a period"
                                                wire:model="filters.input_date_picker.updated_at">
                                        </form>
                                    </div>
                                </div>

                            </td>
                        </tr>



                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="c4ca4238a0b923820dcc509a6f75849b">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="1">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Alena Kerluke PhD
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        eum-commodi-perferendis-assumenda-cupiditate
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px"
                                            src="http://emarket.test/storage/8/1.jpg">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        2
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 08:10:00
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="c81e728d9d4c2f636f067f89cc14862c">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="2">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        2
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Prof. Jaquan Bauch V
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        praesentium-laudantium-eos-enim-sit-asperiores
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="eccbc87e4b5ce2fe28308fd9f2a7baf3">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="3">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        3
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Candido Kris
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        consequatur-aliquid-dolor-illo-laborum-rerum-veritatis-cum-voluptate
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="a87ff679a2f3e71d9181a67b7542122c">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="4">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        4
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Nellie Runte
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        delectus-adipisci-et-quis-sapiente-dignissimos
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="e4da3b7fbbce2345d7772b0674a318d5">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="5">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        5
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Dr. Albin DuBuque V
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        maiores-qui-eligendi-et-eum-et-soluta-dolor
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="1679091c5a880faf6fb5e6087eb1b2dc">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="6">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        6
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Celestine Conn
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        eaque-ut-hic-quis-esse-doloremque
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="8f14e45fceea167a5a36dedd4bea2543">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="7">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        7
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Darryl Cormier V
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        molestias-sed-omnis-possimus-dolores-fugit
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="c9f0f895fb98ab9159f51fd0297e236d">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="8">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        8
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Amie Rath
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        aut-iure-consectetur-cupiditate-alias-reiciendis-labore-ea-ullam
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="45c48cce2e2d7fbdea1afc51c7c6ad26">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="9">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        9
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Trent Bruen Sr.
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        ipsam-distinctio-voluptas-et-ipsam-fugit-perspiciatis-aut
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>

                        <tr style=""
                            class="border border-slate-100 dark:border-slate-400 hover:bg-slate-50 dark:bg-slate-700 dark:odd:bg-slate-800 dark:odd:hover:bg-slate-900 dark:hover:bg-slate-700"
                            wire:key="d3d9446802a44259755d38e6d163e820">



                            <td class="px-6 py-3 text-left text-xs font-medium text-slate-500 tracking-wider"
                                style="">
                                <div class="">
                                    <label class="flex items-center space-x-3">
                                        <input class="h-4 w-4" type="checkbox" wire:model.defer="checkboxValues"
                                            value="10">
                                    </label>
                                </div>
                            </td>

                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        10
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        Hettie Toy
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        eum-aut-veritatis-est-temporibus-laborum
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        <img style="width: 96px; height: 48px" src="">
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        VND 150000
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        1
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style=";  ">
                                <span class="">
                                    <div>
                                        0
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap dark:text-slate-200 " style="display:none;  ">
                                <span class="">
                                    <div>
                                        17/06/2022 07:37:15
                                    </div>
                                </span>
                            </td>



                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <div
                class="justify-between md:flex md:flex-row w-full items-center pt-3 bg-white overflow-y-auto pl-2 pr-2 pb-1 relative
     dark:bg-slate-700">
                <div class="flex flex-row justify-center md:justify-start mb-2 md:mb-0">
                    <div class="relative h-10">
                        <select wire:model.lazy="setUp.footer.perPage"
                            class="block appearance-none bg-slate-50 border border-slate-300 text-slate-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-slate-500  dark:bg-slate-600 dark:text-slate-200 dark:placeholder-slate-200 dark:border-slate-500">
                            <option value="10">
                                10
                            </option>
                            <option value="25">
                                25
                            </option>
                            <option value="50">
                                50
                            </option>
                            <option value="100">
                                100
                            </option>
                            <option value="0">
                                All
                            </option>
                        </select>

                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                            <svg class="pointer-events-none w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-4 hidden sm:block md:block lg:block w-full" style="padding-top: 6px;">
                    </div>
                </div>

                <div>
                    <div class="items-center justify-between sm:flex">
                        <div class="items-center justify-between w-full sm:flex-1 sm:flex">
                            <div>
                                <div
                                    class="mr-2 leading-5 text-center text-slate-700 text-md dark:text-slate-300 sm:text-right">
                                    Showing
                                    <span class="font-semibold firstItem">1</span>
                                    to
                                    <span class="font-semibold lastItem">10</span>
                                    of
                                    <span class="font-semibold total">20</span>
                                    Results
                                </div>
                            </div>

                            <nav role="navigation" aria-label="Pagination Navigation"
                                class="items-center justify-between sm:flex">
                                <div class="flex justify-center mt-2 md:flex-none md:justify-end sm:mt-0">




                                    <span
                                        class="px-2 py-1 m-1 text-center border-slate-400 rounded cursor-pointer border-1 dark:bg-slate-700 dark:text-white dark:text-slate-300">1</span>


                                    <a class="px-2 py-1 m-1 text-center text-white bg-slate-500 border-slate-400 rounded cursor-pointer border-1 hover:bg-slate-600 hover:border-slate-800 dark:text-slate-300"
                                        wire:click="gotoPage(2)">2</a>



                                    <a class="px-2 py-1 pt-2 m-1 text-center text-white bg-slate-500 border-slate-400 rounded cursor-pointer border-1 hover:bg-slate-600 hover:border-slate-800 dark:text-slate-300"
                                        wire:click="gotoPage(2)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-double-right"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
