<!--  MAIN SECTION  -->
<section class="pt-5">
    <div class="container max-w-screen-xl mx-auto px-4">
        <article class="p-4 bg-white border border-gray-200 shadow-sm rounded-md">
            <div class="flex flex-col md:flex-row">
                <aside class="md:w-1/4 flex-auto mb-4 pr-4 md:mb-0">
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a class="block px-3 py-2 hover:bg-blue-50 rounded-md hover:text-blue-600"
                                    href="#">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </aside>
                <main class="md:w-3/4 flex-auto">
                    <!-- banner-main -->
                    <article class="bg-blue-500 p-6 lg:p-16 rounded w-full h-full">
                        <h1 class="text-3xl md:text-4xl text-white font-semibold">
                            Best products &amp; <br>brands in our store
                        </h1>
                        <p class="text-lg text-white font-normal mt-4 mb-6">
                            Trendy Products, Factory Prices, Excellent Service
                        </p>
                        <div>
                            <a class="px-4 py-2 inline-block font-semibold bg-yellow-500 text-white border border-transparent rounded-md hover:bg-yellow-600"
                                href="#">
                                Discover
                            </a>
                            <a class="px-4 py-2 inline-block font-semibold text-blue-600 border border-transparent rounded-md hover:bg-gray-100 bg-white"
                                href="#">
                                Learn more
                            </a>
                        </div>
                    </article>
                    <!-- banner-main end// -->
                </main>
            </div> <!-- grid.// -->
        </article>


    </div> <!-- container //end -->
</section>
<!--  MAIN SECTION //END -->

<!-- SECTION-CONTENT -->
<section class="py-10">
    <div class="container max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8">New products</h2>

        <div class="grid auto-rows-max grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($newProducts as $product)
                <!-- COMPONENT: PRODUCT CARD -->
                <article class="shadow-sm rounded bg-white border border-gray-200">
                    <a href="{{ route('site.product.show', $product) }}" class="relative block p-1">
                        <img src="images/items/10.jpg" class="mx-auto w-auto" style="height: 250px" height="250"
                            alt="{{ $product->name }}">
                        <span
                            class="inline-block px-3 py-1 text-sm bg-red-100 text-red-600 rounded-full absolute left-3 top-3">
                            Offer
                        </span>
                    </a>
                    <div class="p-4 border-t border-t-gray-200">
                        <a class="float-right px-3 py-2 text-gray-400 border border-gray-300 rounded-md hover:border-blue-400 hover:text-blue-600"
                            href="#">
                            <i class="fa fa-heart"></i>
                        </a>
                        <h6>
                            <a href="#" class="text-gray-600 hover:text-blue-500">{{ $product->name }}</a>
                        </h6>
                        @forelse ($product->variationOptions as $option)
                            <p class="text-sm text-gray-400">
                                {{ $option->name }}:
                                {{ collect($option->values)->map(fn($item) => $item->value)->join(', ') }}
                            </p>
                        @empty
                        @endforelse
                        <span class="font-semibold">{{ $product->price_vnd }}</span>
                    </div>
                </article>
                <!-- COMPONENT: PRODUCT CARD //END -->
            @endforeach
        </div> <!-- grid .// -->
    </div>
</section>
<!--  SECTION-CONTENT  //END -->
