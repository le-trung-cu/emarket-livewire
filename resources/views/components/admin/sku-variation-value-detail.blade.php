@php
$sku = App\Models\SKU::find($id);
@endphp
<div class="p-5">
    @foreach ($sku->variationValues as $value)
        <div class="flex items-center">
            <span class="font-semibold text-sm mr-5">{{ $options[$value->variation_option_id][0] }}: </span>
            @if ($options[$value->variation_option_id][1] === 'text')
                <span>{{ $value->value }}</span>
            @elseif ($options[$value->variation_option_id][1] === 'color')
                <span style="background: {{ $value->value }};" class="w-7 h-7 block"></span>
            @endif
        </div>
    @endforeach
</div>
