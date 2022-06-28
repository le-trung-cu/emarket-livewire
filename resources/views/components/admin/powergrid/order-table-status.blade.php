<div>
    <div @class([
        "font-normal text-xs rounded-md w-[70px] h-5 flex justify-center items-center border-2",
        // "border-orange-300 bg-orange-50 text-orange-400" => $status === 'Registered',
        "border-teal-300 bg-teal-50 text-teal-400" => $status === 'Registered',
        "border-green-300 bg-green-50 text-green-400" => $status === 'Complated',
        "border-blue-300 bg-blue-50 text-blue-400" => $status === 'Pending',
        "border-red-300 bg-red-50 text-red-400" => $status === 'Canceled',
        "border-yellow-300 bg-yellow-50 text-yellow-400" => $status === 'Packing',
        "border-gray-300 bg-gray-50 text-gray-400" => $status === 'Sent',
        ])>
        {{$status}}
    </div>
</div>