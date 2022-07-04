@props(['categories'])

@if($categories->count())
<aside class="flex-auto mb-4 pr-4 md:mb-0 pl-10">
    <h3 class="text-lg font-medium my-2 text-gray-600">Categories</h3>
    <ul>
        @foreach ($categories as $category)
            <li>
                <a class="block px-3 py-2 text-gray-500 hover:bg-blue-50 rounded-md hover:text-blue-600"
                    href="{{route('site.categories.products', $category)}}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
</aside>
@endif
