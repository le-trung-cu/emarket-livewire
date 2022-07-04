<section class="bg-blue-100 py-4">
    <div class="container max-w-screen-xl mx-auto px-4">
        <!-- breadcrumbs start -->
        <ol class="inline-flex flex-wrap text-gray-600 space-x-1 md:space-x-3 items-center">
            @foreach ($category->ancestors as $item)
                <li class="inline-flex items-center">
                    <a class="text-gray-600 hover:text-blue-600"
                        href="{{ route('site.categories.products', $item) }}">{{ $item->name }}</a>
                    <i class="ml-3 text-gray-400 fa fa-chevron-right"></i>
                </li>
            @endforeach
            <li class="inline-flex items-center">
                <a class="text-gray-600 hover:text-blue-600"
                    href="{{ route('site.categories.products', $category) }}">{{ $category->name }}</a>
                @if ($product)
                    <i class="ml-3 text-gray-400 fa fa-chevron-right"></i>
                @endif
            </li>
            @if ($product)
                <li class="inline-flex items-center">
                    <a class="text-gray-600 hover:text-blue-600" href="#">{{ $product->name }}</a>
                </li>
            @endif
        </ol>
        <!-- breadcrumbs end -->
    </div> <!-- container .// -->
</section>
