<a class="px-3 py-2 inline-block text-center text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:border-gray-300"
    href="#">
    <div class="relative inline-block">
        <i class="text-gray-400 w-5 fa fa-shopping-cart"></i>
        @if ($count)
            <div
                class="absolute -top-2 -right-2 w-5 h-5 bg-blue-500 text-gray-300 rounded-full flex justify-center items-center text-sm">
                {{ $count }}
            </div>
        @endif
    </div>
    <span class="hidden lg:inline ml-1">My cart</span>
</a>
