<div class="w-full" x-data="{
    isEditing: false,
    isName: '{{ $isName }}',
    focus: function() {
        const textInput = this.$refs.textInput;
        textInput.focus();
        textInput.select();
    }
}" x-cloak>
    <div @class([
        'p-2 border border-gray-100 flex justify-between items-center',
        'bg-gray-500' => $selectedId == $category->id,
    ]) x-show=!isEditing>
        <span class="cursor-pointer" x-bind:class="{ 'font-bold': isName }"
            wire:click="$emitUp('categoryLv{{ $level }}Change', {{ $category->id }})">{{ $category->name }}</span>
        <div class="">
            <button class="rounded-md text-purple-600 focus:outline-none focus:shadow-outline-purple" title="edit"
                @click="isEditing = true; $nextTick(() => focus())">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4.75 19.25L9 18.25L18.2929 8.95711C18.6834 8.56658 18.6834 7.93342 18.2929 7.54289L16.4571 5.70711C16.0666 5.31658 15.4334 5.31658 15.0429 5.70711L5.75 15L4.75 19.25Z">
                    </path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M19.25 19.25H13.75"></path>
                </svg>
            </button>
            <button title="delete" class="mr-2 text-red-600"
                wire:click="$emitUp('confirmDeleteCategory', {{ $category->id }})">
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
        </div>

    </div>
    <div x-show=isEditing class="flex flex-col">
        <form class="flex flex-col bg-white shadow shadow-black p-2" wire:submit.prevent="save">
            <div class="flex justify-end">
                <button type="submit" class="px-1 ml-1 text-3xl font-bold text-green-600" title="Save"
                    x-on:click="isEditing = false">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21"
                        fill="currentColor">
                        <path d="m.5 5.5 3 3 8.028-8" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" transform="translate(5 6)"></path>
                    </svg>
                </button>
                <button type="button" class="px-1 ml-2 text-3xl text-red-900" title="Cancel"
                    x-on:click="isEditing = false">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24"
                        aria-labelledby="cancelIconTitle" fill="none" stroke="currentColor">
                        <title id="cancelIconTitle">Cancel</title>
                        <path
                            d="M15.5355339 15.5355339L8.46446609 8.46446609M15.5355339 8.46446609L8.46446609 15.5355339">
                        </path>
                        <path
                            d="M4.92893219,19.0710678 C1.02368927,15.1658249 1.02368927,8.83417511 4.92893219,4.92893219 C8.83417511,1.02368927 15.1658249,1.02368927 19.0710678,4.92893219 C22.9763107,8.83417511 22.9763107,15.1658249 19.0710678,19.0710678 C15.1658249,22.9763107 8.83417511,22.9763107 4.92893219,19.0710678 Z">
                        </path>
                    </svg>
                </button>
            </div>
            <label for="name">name:</label>
            <input id="name" type="text" class="block px-2 border border-gray-400 text-sm shadow-inner"
                placeholder="100 characters max." x-ref="textInput" wire:model="name"
                x-on:keydown.enter="isEditing = false" x-on:keydown.escape="isEditing = false" />

            <label for="slug" class="mt-3">slug:</label>
            <input id="slug" type="text" class="px-2 block border border-gray-400 text-sm shadow-inner"
                placeholder="100 characters max." wire:model="slug" x-on:keydown.enter="isEditing = false"
                x-on:keydown.escape="isEditing = false" />
        </form>
        <small class="text-xs">Enter to save, Esc to cancel</small>
    </div>
</div>
