<article class="group hover:shadow shadow-gray-400 p-4">
    <div class="relative">
        <a href="{{ route('site.product.show', $product) }}" class="relative block p-1">
            <img src="{{$product->thumbnail ?? 'images/items/10.jpg'}}" alt="{{ $product->name }}" style="height: 204px; width: auto;"/>
        </a>
        <div class="absolute top-0 right-0 h-full w-11 flex flex-col overflow-hidden">
            <button
                wire:click="addToCart"
                class="p-1 translate-x-full group-hover:translate-x-0 transition-transform duration-500 text-gray-400 hover:text-gray-900"
                title="Add To Cart">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" fill="currentColor">
                    <path
                        d="M35 34H13c-.3 0-.6-.2-.8-.4s-.2-.6-.1-.9l1.9-4.8L12.1 10H6V8h7c.5 0 .9.4 1 .9l2 19c0 .2 0 .3-.1.5L14.5 32H36l-1 2z">
                    </path>
                    <path d="M15.2 29l-.4-2L38 22.2V14H14v-2h25c.6 0 1 .4 1 1v10c0 .5-.3.9-.8 1l-24 5z"></path>
                    <path
                        d="M36 40c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                    </path>
                    <path
                        d="M12 40c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                    </path>
                </svg>
            </button>

            <button
                class="p-1 translate-x-full group-hover:translate-x-0 transition-transform duration-500 delay-75 text-gray-400 hover:text-gray-900"
                title="Quick View">
                <svg class="w-7 h-7" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 9L4 4M4 4V8M4 4H8" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                    <path d="M15 9L20 4M20 4V8M20 4H16" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M9 15L4 20M4 20V16M4 20H8" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M15 15L20 20M20 20V16M20 20H16" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </button>

            <button
                class="p-1 translate-x-full group-hover:translate-x-0 transition-transform duration-500 delay-100 text-gray-400 hover:text-gray-900"
                title="Add To Wishlist">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M6.736 4C4.657 4 2.5 5.88 2.5 8.514c0 3.107 2.324 5.96 4.861 8.12a29.66 29.66 0 004.566 3.175l.073.041.073-.04c.271-.153.661-.38 1.13-.674.94-.588 2.19-1.441 3.436-2.502 2.537-2.16 4.861-5.013 4.861-8.12C21.5 5.88 19.343 4 17.264 4c-2.106 0-3.801 1.389-4.553 3.643a.75.75 0 01-1.422 0C10.537 5.389 8.841 4 6.736 4zM12 20.703l.343.667a.75.75 0 01-.686 0l.343-.667zM1 8.513C1 5.053 3.829 2.5 6.736 2.5 9.03 2.5 10.881 3.726 12 5.605 13.12 3.726 14.97 2.5 17.264 2.5 20.17 2.5 23 5.052 23 8.514c0 3.818-2.801 7.06-5.389 9.262a31.146 31.146 0 01-5.233 3.576l-.025.013-.007.003-.002.001-.344-.666-.343.667-.003-.002-.007-.003-.025-.013A29.308 29.308 0 0110 20.408a31.147 31.147 0 01-3.611-2.632C3.8 15.573 1 12.332 1 8.514z">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div>
        <h4>
            <a href="{{ route('site.product.show', $product) }}"class="hover:text-blue-400">
                {{ $product->name }}
            </a>
        </h4>
        @if (!$product->variationOptions->isEmpty())
            <p class="font-light text-gray-400">Variantion on:
                {{ $product->variationOptions->map(fn($item) => $item->name)->join(', ') }}</p>
        @endif
        <span class="font-medium text-gray-400 group-hover:text-red-400">{{ $product->regular_price }}</span>
    </div>
</article>
