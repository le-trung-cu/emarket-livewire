<div>
    <!--  PAGE HEADER -->
    <section class="py-5 sm:py-7 bg-blue-100">
        <div class="container max-w-screen-xl mx-auto px-4">
            <!-- breadcrumbs start -->
            <h2 class="text-3xl font-semibold mb-2">Your order is create success!</h2>
        </div><!-- /.container -->
    </section>
    <!--  PAGE HEADER .//END  -->

    <section class="py-10">
        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="flex flex-col md:flex-row gap-4">
                <main class="md:w-3/4 m-auto">

                    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">
                        @foreach ($orderGroup as $subOrder)
                            @foreach ($subOrder->orderItems as $item)
                                <!-- item-cart -->
                                <div class="flex flex-wrap lg:flex-row gap-5  mb-4">
                                    <div class="w-full lg:w-2/5 xl:w-2/4">
                                        <figure class="flex leading-5">
                                            <div>
                                                <div
                                                    class="block w-16 h-16 rounded border border-gray-200 overflow-hidden">
                                                    <img src="{{ $item->sku->product->thumbnail }}" alt="{{$item->product_name}}">
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
                                    {{ $subOrder->shipping_fee }}</span>
                            </p>
                            <hr class="my-4">
                        @endforeach
                        <h6 class="font-bold">Free Delivery within 1-2 weeks</h6>
                        <div class="p-2 bg-green-100 my-5 rounded-md">
                            @if (count($orderGroup) > 1)
                                <p class="font-semibold text-sm">Because your cart contains products from diference
                                    place so your order will
                                    deliver in multiple times!</p>
                            @endif
                            <p>
                                <span class="font-semibold text-sm">shipping address:</span> <span
                                    class=" text-green-600 ">{{ $order->shipping_address }}</span>
                            </p>
                        </div>
                    </article> <!-- card end.// -->

                    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">
                        <x-input label="Name" placeholder="your name" disabled :value="$order->recipient_name" />
                        <div class="h-5"></div>
                        <x-input label="Phone" placeholder="your phone" disabled :value="$order->recipient_phone" />
                    </article>

                    <aside class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">

                        <article>

                            <ul class="mb-5">
                                <li class="flex justify-between text-gray-600  mb-1">
                                    <span>Total price:</span>
                                    <span>{{ $amountTotal }}</span>
                                </li>
                                <li class="flex justify-between text-gray-600  mb-1">
                                    <span>Discount:</span>
                                    <span class="text-green-500">- đ0</span>
                                </li>
                                <li class="flex justify-between text-gray-600  mb-1">
                                    <span>Shipping fee:</span>
                                    <span class="text-green-500">{{ $shippingFeeTotal }}</span>
                                </li>
                                <li class="text-lg font-bold border-t flex justify-between mt-3 pt-3">
                                    <span>Total price:</span>
                                    <span>{{ $totalPrice }}</span>
                                </li>
                            </ul>

                            <p class="text-lg font-bold text-blue-600 uppercase">Payment Success!</p>
                            {{-- Payment menthods --}}
                            <div class="flex">
                                <div class="p-2">
                                    <label class="relative w-32 h-16 inline-block border-gray-300 border-2"
                                        style="background-size: contain; background-repeat: no-repeat; background-image: url('{{ asset('images/misc/cash.jpg') }}');">
                                        <input class="hidden" type="radio" name="paymentTypeId" value="cash"
                                            disabled>
                                        @if ($paymentType == 'cash')
                                            <div class="absolute -top-3 -right-3 text-blue-500">
                                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm16.28-2.72a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </label>
                                </div>
                                <div class="p-2">
                                    <label class="relative w-32 h-16 inline-block border-gray-300 border-2"
                                        style="background-size: contain; background-repeat: no-repeat; background-image: url('{{ asset('images/misc/payment-card.png') }}');">
                                        <input class="hidden" type="radio" name="paymentTypeId" value="bank_transfer"
                                            disabled>
                                        @if ($paymentType == 'bank_transfer')
                                            <div class="absolute -top-3 -right-3 text-blue-500">
                                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm16.28-2.72a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </label>
                                </div>
                                <div class="p-2">
                                    <label class="relative w-32 h-16 inline-block border-gray-300 border-2"
                                        style="background-size: contain; background-repeat: no-repeat; background-image: url('{{ asset('images/misc/payment-paypal.png') }}');">
                                        <input class="hidden" type="radio" name="paymentTypeId" value="3"
                                            disabled>
                                        @if ($paymentType == 3)
                                            <div class="absolute -top-3 -right-3 text-blue-500">
                                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm16.28-2.72a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <x-errors class="my-5" />
                            <a class="px-4 py-3 inline-block text-lg w-full text-center font-medium text-green-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100"
                                href="{{ route('site.home') }}"> Back to shop </a>

                        </article> <!-- card end.// -->

                    </aside> <!-- col.// -->
                </main>

            </div> <!-- grid.// -->

        </div>
    </section>

    <x-modal wire:model.defer="isShowPickAddressModal">
        <x-card title="Shipping Address">
            <livewire:select-address />
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save Address"
                        wire:click="$emitTo('select-address', 'pickAddressEvent')" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
