@php
    $order = \App\Models\Order::find($id);
@endphp

<div>
    <livewire:admin.order-detail :order="$order"/>
    <aside class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">

        <article>

            <ul class="mb-5">
                <li class="flex justify-between text-gray-600  mb-1">
                    <span>Total price:</span>
                    <span>{{ $order->amount }}</span>
                </li>
                <li class="flex justify-between text-gray-600  mb-1">
                    <span>Discount:</span>
                    <span class="text-green-500">- đ0</span>
                </li>
                <li class="flex justify-between text-gray-600  mb-1">
                    <span>Shipping fee:</span>
                    <span class="text-green-500">{{ $order->shipping_fee }}</span>
                </li>
                <li class="text-lg font-bold border-t flex justify-between mt-3 pt-3">
                    <span>Total price:</span>
                    <span>{{ $order->amount->plus($order->shipping_fee) }}</span>
                </li>
            </ul>

            {{-- Payment menthods --}}
            {{-- <div class="flex">
                <div class="p-2">
                    <label class="relative w-32 h-16 inline-block border-gray-300 border-2"
                        style="background-size: contain; background-repeat: no-repeat; background-image: url('{{ asset('images/misc/cash.jpg') }}');">
                        <input class="hidden" type="radio" name="paymentTypeId" value="1"
                            disabled>
                        @if ($paymentTypeId == 1)
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
                        <input class="hidden" type="radio" name="paymentTypeId" value="2"
                            disabled>
                        @if ($paymentTypeId == 2)
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
                        @if ($paymentTypeId == 3)
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
            </div> --}}
        </article> <!-- card end.// -->

    </aside>
</div>