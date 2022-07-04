@php
    $order = \App\Models\Order::findOrFail($id)
@endphp
<div class="p-10">
    <div class="flex space-x-8 text-sm mb-5 border-b border-gray-100">
        <div><span class="text-gray-500 font-light">OrderID: </span><span
                class="font-medium text-black">{{ $order->id }}</span></div>
        <div><span class="text-gray-500 font-light">Date: </span><span
                class="font-medium text-black">{{ $order->created_at }}</span></div>
        <div><span class="text-gray-500 font-light">Order Status: </span><span
                class="font-medium text-black">{{ $order->status->labels() }}</span></div>
        <div><span class="text-gray-500 font-light">Amount: </span><span
                class="font-medium text-black">{{ $order->amount }}</span></div>
        <div><span class="text-gray-500 font-light">Shipping fee: </span><span
                class="font-medium text-black">{{ $order->shipping_fee }}</span></div>
        <div><span class="text-gray-500 font-light">Total: </span><span
                class="font-medium text-black">{{ $order->amount->plus($order->shipping_fee) }}</span></div>
    </div>
    <table>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td class="py-2 w-20">
                        <x-admin.powergrid.product-table-thumbnail :thumbnail="$item->sku->product->thumbnail"/>
                        {{-- <div class="block w-16 h-16 rounded border border-gray-200 overflow-hidden">
                            <img src="{{ $item->sku->product->thumbnail }}" alt="{{ $item->product_name }}">
                        </div> --}}
                    </td>
                    <td class="py-2 max-w-sm">
                        <div class="flex flex-col justify-between">
                            <p class="flex flex-col">
                                <a href="{{ route('site.product.show', $item->sku->product) }}"
                                    class="hover:text-blue-600">{{ $item->product_name }}</a>
                                <span class="text-xs text-purple-400 font-medium">{{$item->variation_string}}</span>
                            </p>
                            <span class="text-sm text-gray-600">{{ $item->price }}</span>
                        </div>
                    </td>
                    <td class="py-2">
                        <p>
                            <span class="font-light text-sm">SKU: </span>
                            <span class="text-sm text-gray-600 font-medium"> {{ $item->sku->barcode }}</span>
                        </p>
                    </td>
                    <td class="py-2">
                        <p>
                            <span class="font-light text-sm">Qty: </span>
                            <span class="text-sm text-gray-600 font-medium"> {{ $item->qty }}</span>
                        </p>
                    </td>
                    <td class="py-2">
                        <p>
                            <span class="font-light text-sm text-gray-600">amount: </span>
                            <span class="text-sm font-medium "> {{ $item->amount }}</span>
                        </p>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <p>
                        <span class="font-light text-sm text-gray-600">Buyer Name: </span>
                        <span class="text-sm font-medium"> {{ $order->buyer->name }}</span>
                    </p>
                    <p>
                        <span class="font-light text-sm text-gray-600">Recipient Name: </span>
                        <span class="text-sm font-medium"> {{ $order->recipient_name }}</span>
                    </p>
                    <p>
                        <span class="font-light text-sm text-gray-600">Recipient Phone: </span>
                        <span class="text-sm font-medium"> {{ $order->recipient_phone }}</span>
                    </p>
                    <p>
                        <span class="font-light text-sm text-gray-600">Shipping address: </span>
                        <span class="text-sm font-medium"> {{ $order->shipping_address }}</span>
                    </p>
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-10 flex space-x-3">
        @if ($order->status->labels() === 'Pending')
            <x-button xs wire:click="$emitUp('confirmOrder', {{ $order->id }})" icon="check" spinner teal
                label="Comfirm" />
        @endif
        @if ($order->order_code_ghn)
            <x-button wire:click="$emitTo('admin.order-list', 'printOrder', {{$order->id}})" xs icon="clipboard-list" spinner teal
                label="Print bill of lading" />
        @endif

    </div>
</div>
