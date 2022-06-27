<div>
    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">
        @foreach ($order->orderItems as $item)
            <!-- item-cart -->
            <div class="flex flex-wrap lg:flex-row gap-5  mb-4">
                <div class="w-full lg:w-2/5 xl:w-2/4">
                    <figure class="flex leading-5">
                        <div>
                            <div class="block w-16 h-16 rounded border border-gray-200 overflow-hidden">
                                <img src="{{ $item->sku->product->thumbnail }}" alt="{{ $item->product_name }}">
                            </div>
                        </div>
                        <figcaption class="ml-3">
                            <p><a href="{{ route('site.product.show', $item->sku->product) }}"
                                    class="hover:text-blue-600">{{ $item->product_name }}</a></p>
                        </figcaption>
                    </figure>
                </div>
                <div class="">
                    <!-- selection -->
                    <div class="w-24 relative">
                        <div class="flex justify-center items-center">
                            <input disabled value="{{ $item->qty }}"
                                class="w-12 h-7 border border-gray-500 text-center" />
                        </div>
                    </div>
                    <!-- selection .//end -->
                </div>
                <div>
                    <div class="leading-5">
                        <p class="font-semibold not-italic">{{ $item->amount }}</p>
                        <small class="text-gray-400"> {{ $item->price }} / per item </small>
                    </div>
                </div>
            </div> <!-- item-cart end// -->
        @endforeach
        <p class="p-2 bg-green-100 my-5 rounded-md text-green-600">
            <span class="font-semibold"> Shipping Fee:
                {{ $order->shipping_fee }}</span>
        </p>
        <hr class="my-4">
        <h6 class="font-bold">Free Delivery within 1-2 weeks</h6>
        <div class="p-2 bg-green-100 my-5 rounded-md">
            <p>
                <span class="font-semibold text-sm">shipping address:</span> <span
                    class=" text-green-600 ">{{ $order->shipping_address }}</span>
            </p>
        </div>
    </article> <!-- card end.// -->
</div>
