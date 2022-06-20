<p @class([
    "flex justify-center items-center py-1 rounded-full font-semibold w-20 text-xs",
    "bg-green-100 text-green-600" => $status->name === 'ACTIVE',
    "bg-yellow-100 text-yellow-600" => $status->name === 'INACTIVE',
    "bg-red-100 text-red-600" => $status->name === 'OUT_OF_STOCK',
    ])>{{$status->labels()}}</p>