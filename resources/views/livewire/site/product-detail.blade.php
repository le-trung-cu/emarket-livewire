<div>
    <section class="bg-blue-100 py-4">
        <div class="container max-w-screen-xl mx-auto px-4">
            <!-- breadcrumbs start -->
            <ol class="inline-flex flex-wrap text-gray-600 space-x-1 md:space-x-3 items-center">
                <li class="inline-flex items-center">
                    <a class="text-gray-600 hover:text-blue-600" href="#">Home</a>
                    <i class="ml-3 text-gray-400 fa fa-chevron-right"></i>
                </li>
                <li class="inline-flex items-center" aria-current="page">
                    <a class="text-gray-600 hover:text-blue-600" href="#"> Clothes </a>
                    <i class="ml-3 text-gray-400  fa fa-chevron-right"></i>
                </li>
                <li class="inline-flex items-center" aria-current="page">
                    <a class="text-gray-600 hover:text-blue-600" href="#"> Men's wear </a>
                    <i class="ml-3 text-gray-400  fa fa-chevron-right"></i>
                </li>
                <li class="inline-flex items-center"> Detail </li>
            </ol>
            <!-- breadcrumbs end -->
        </div> <!-- container .// -->
    </section>
    <section class="bg-white py-10">
        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <aside x-data="photoGalleryApp">
                    <!-- gallery -->
                    <div class="border border-gray-200 shadow-sm p-3 text-center rounded mb-5">
                        <img x-ref="mainImage" width="400" class="w-full sm:w-auto sm:h-80" srcset=""
                            sizes="73vw" />
                        {{-- <img class="object-cover inline-block" width="400" src="images/items/detail/big.jpg"
                            alt="Product title"> --}}
                    </div>
                    <div class="flex space-x-2 overflow-auto text-center whitespace-nowrap">
                        @foreach ($galaries as $key => $galary)
                            <div href="#" x-on:click="pickPhoto({{ $key }})" class="cursor-pointer"
                                class="inline-block border border-gray-200 p-1 rounded-md hover:border-blue-500">
                                <img class="w-14 h-14"
                                    :class="{ 'ring-2 opacity-50': currentPhoto == {{ $key }} }"
                                    src="{{ $galary->preview_url }}" alt="Product title"
                                    onload="window.requestAnimationFrame(function(){
                                        if(!(size=getBoundingClientRect().width))return;
                                        onload=null;
                                        sizes=Math.ceil(size/window.innerWidth*100)+'vw';
                                        });" />
                            </div>
                        @endforeach
                    </div>
                    <!-- gallery end.// -->
                </aside>
                <main>
                    <h2 class="font-semibold text-2xl mb-4">
                        {{ $product->name }}
                    </h2>

                    <div class="flex flex-wrap items-center space-x-2 mb-2">

                        <img class="d-inline-block h-4" src="images/misc/stars-active.svg" alt="Rating">
                        <span class="text-yellow-500">9.3</span>

                        <svg width="6px" height="6px" viewbox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="3" cy="3" r="3" fill="#DBDBDB" />
                        </svg>

                        <span class="text-gray-400">
                            <i class="fa fa-shopping-bag mr-2"></i> 154 orders
                        </span>

                        <svg width="6px" height="6px" viewbox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="3" cy="3" r="3" fill="#DBDBDB" />
                        </svg>

                        <span class="text-green-500">Verified</span>

                    </div>

                    <p class="mb-4 font-semibold text-xl">{{ $product->price_vnd }}</p>

                    <p class="mb-4 text-gray-500">
                        Virgil Abloh’s Off-White is a streetwear-inspired collection that
                        continues to break away from the conventions of mainstream fashion. Made in Italy, these black
                        and brown Odsy-1000 low-top sneakers.
                    </p>


                    <ul class="mb-5">
                        <li class="mb-1"> <b class="font-medium w-36 inline-block">Model#:</b>
                            <span class="text-gray-500">Odsy-1000</span>
                        </li>
                        <li class="mb-1"> <b class="font-medium w-36 inline-block">Color:</b>
                            <span class="text-gray-500">Brown</span>
                        </li>
                        <li class="mb-1"> <b class="font-medium w-36 inline-block">Delivery:</b>
                            <span class="text-gray-500">Russia, USA & Europe</span>
                        </li>
                        <li class="mb-1"> <b class="font-medium w-36 inline-block">Color:</b>
                            <span class="text-gray-500">Brown</span>
                        </li>
                    </ul>

                    <div class="flex flex-wrap mb-4">
                        <!-- select-custom -->
                        <div class="relative w-1/3 lg:w-1/4 mr-2 mb-4">
                            <select
                                class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 pr-5 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full">
                                <option>Select size</option>
                                <option>Extra large</option>
                                <option>Medium size</option>
                                <option>Normal size</option>
                            </select>
                            <i
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                <svg width="24" height="24" class="fill-current h-5 w-5" viewBox="0 0 24 24">
                                    <path d="M7 10l5 5 5-5H7z" />
                                </svg>
                            </i>
                        </div>
                        <!-- select-custom .//end  -->

                        <!-- select-custom -->
                        <div class="relative w-1/3 lg:w-1/4 mr-2 mb-4">
                            <select
                                class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 pr-5 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full">
                                <option>Select color</option>
                                <option>Lightblue</option>
                                <option>Green</option>
                                <option>Black</option>
                            </select>
                            <i
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                <svg width="24" height="24" class="fill-current h-5 w-5" viewBox="0 0 24 24">
                                    <path d="M7 10l5 5 5-5H7z" />
                                </svg>
                            </i>
                        </div>
                        <!-- select-custom .//end  -->
                    </div>
                    <!-- action buttons -->
                    <div class="flex flex-wrap gap-2">
                        <a class="px-4 py-2 inline-block text-white bg-yellow-500 border border-transparent rounded-md hover:bg-yellow-600"
                            href="#">
                            Buy now
                        </a>
                        <a class="px-4 py-2 inline-block text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700"
                            href="#">
                            <i class="fa fa-shopping-cart mr-2"></i>
                            Add to cart
                        </a>
                        <a class="px-4 py-2 inline-block text-blue-600 border border-gray-300 rounded-md hover:bg-gray-100"
                            href="#">
                            <i class="fa fa-heart mr-2"></i>
                            Save for later
                        </a>
                    </div>
                    <!-- action buttons .//end -->
                </main>
            </div> <!-- grid .// -->
        </div> <!-- container .// -->
    </section>

    <section class="bg-gray-100 py-10">
        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="flex flex-wrap -mx-2">
                <div class="lg:w-3/4 px-2">

                    <article class="border border-gray-200 shadow-sm rounded bg-white">
                        <nav class="border-b px-4">
                            <a href="#"
                                class="px-3 py-4 mx-1 inline-block border-b border-blue-600 text-blue-600 hover:border-blue-600 hover:text-blue-500">Overview</a>
                            <a href="#"
                                class="px-3 py-4 mx-1 inline-block hover:border-blue-600 hover:text-blue-500">Specification</a>
                            <a href="#"
                                class="px-3 py-4 mx-1 inline-block hover:border-blue-600 hover:text-blue-500">Delivery</a>
                            <a href="#"
                                class="px-3 py-4 mx-1 inline-block hover:border-blue-600 hover:text-blue-500">Payment
                                info</a>
                            <a href="#"
                                class="px-3 py-4 mx-1 inline-block hover:border-blue-600 hover:text-blue-500">Seller
                                profile</a>
                        </nav>
                        <div class="p-5 text-gray-700">
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. <br> Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <p class="mb-3">
                                Dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. <br> Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <p class="mb-3">
                                Consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur.
                            </p>
                        </div>
                    </article>
                </div> <!-- col.// -->
                <aside class="lg:w-1/4 px-2">

                    <article class="border border-gray-200 shadow-sm rounded bg-white p-4">
                        <h3 class="mb-5 text-lg font-semibold">Similar products</h3>

                        <figure class="flex flex-row mb-4">
                            <div>
                                <a href="#"
                                    class="block w-20 h-20 rounded border border-gray-200 overflow-hidden">
                                    <img src="images/items/8.jpg" alt="Title">
                                </a>
                            </div>
                            <figcaption class="ml-3">
                                <p><a href="#" class="text-gray-600 hover:text-blue-600">Travel Bag Jeans Blue
                                        Color Modern</a></p>
                                <p class="mt-1 font-semibold">$712.00</p>
                            </figcaption>
                        </figure>

                        <figure class="flex flex-row mb-4">
                            <div>
                                <a href="#"
                                    class="block w-20 h-20 rounded border border-gray-200 overflow-hidden">
                                    <img src="images/items/9.jpg" alt="Title">
                                </a>
                            </div>
                            <figcaption class="ml-3">
                                <p><a href="#" class="text-gray-600 hover:text-blue-600">Apple Watch Series 4 -
                                        Space Gray</a></p>
                                <p class="mt-1 font-semibold">$12.99</p>
                            </figcaption>
                        </figure>

                        <figure class="flex flex-row mb-4">
                            <div>
                                <a href="#"
                                    class="block w-20 h-20 rounded border border-gray-200 overflow-hidden">
                                    <img src="images/items/10.jpg" alt="Title">
                                </a>
                            </div>
                            <figcaption class="ml-3">
                                <p><a href="#" class="text-gray-600 hover:text-blue-600">Apple Watch Series 4 -
                                        Space Gray</a></p>
                                <p class="mt-1 font-semibold">$12.99</p>
                            </figcaption>
                        </figure>

                        <figure class="flex flex-row mb-4">
                            <div>
                                <a href="#"
                                    class="block w-20 h-20 rounded border border-gray-200 overflow-hidden">
                                    <img src="images/items/11.jpg" alt="Title">
                                </a>
                            </div>
                            <figcaption class="ml-3">
                                <p><a href="#" class="text-gray-600 hover:text-blue-600">Apple Watch Series 4 -
                                        Space Gray</a></p>
                                <p class="mt-1 font-semibold">$12.99</p>
                            </figcaption>
                        </figure>

                    </article>

                </aside> <!-- col.// -->
            </div> <!-- grid.// -->

        </div> <!-- container.// -->
    </section>

    {{-- <img srcset="
        http://emarket.test/storage/1/responsive-images/1___galary_922_351.jpg 922w, 
        http://emarket.test/storage/1/responsive-images/1___galary_771_294.jpg 771w,
        http://emarket.test/storage/1/responsive-images/1___galary_645_246.jpg 645w, 
        http://emarket.test/storage/1/responsive-images/1___galary_539_205.jpg 539w, 
        http://emarket.test/storage/1/responsive-images/1___galary_451_172.jpg 451w, 
        http://emarket.test/storage/1/responsive-images/1___galary_377_144.jpg 377w, 
        data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgOTIyIDM1MSI+Cgk8aW1hZ2Ugd2lkdGg9IjkyMiIgaGVpZ2h0PSIzNTEiIHhsaW5rOmhyZWY9ImRhdGE6aW1hZ2UvanBlZztiYXNlNjQsLzlqLzRBQVFTa1pKUmdBQkFRRUFZQUJnQUFELy9nQTdRMUpGUVZSUFVqb2daMlF0YW5CbFp5QjJNUzR3SUNoMWMybHVaeUJKU2tjZ1NsQkZSeUIyT0RBcExDQnhkV0ZzYVhSNUlEMGdPVEFLLzlzQVF3QURBZ0lEQWdJREF3TURCQU1EQkFVSUJRVUVCQVVLQndjR0NBd0tEQXdMQ2dzTERRNFNFQTBPRVE0TEN4QVdFQkVURkJVVkZRd1BGeGdXRkJnU0ZCVVUvOXNBUXdFREJBUUZCQVVKQlFVSkZBMExEUlFVRkJRVUZCUVVGQlFVRkJRVUZCUVVGQlFVRkJRVUZCUVVGQlFVRkJRVUZCUVVGQlFVRkJRVUZCUVVGQlFVRkJRVS84QUFFUWdBREFBZ0F3RWlBQUlSQVFNUkFmL0VBQjhBQUFFRkFRRUJBUUVCQUFBQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVFBQUlCQXdNQ0JBTUZCUVFFQUFBQmZRRUNBd0FFRVFVU0lURkJCaE5SWVFjaWNSUXlnWkdoQ0NOQ3NjRVZVdEh3SkROaWNvSUpDaFlYR0JrYUpTWW5LQ2txTkRVMk56ZzVPa05FUlVaSFNFbEtVMVJWVmxkWVdWcGpaR1ZtWjJocGFuTjBkWFozZUhsNmc0U0Zob2VJaVlxU2s1U1ZscGVZbVpxaW82U2xwcWVvcWFxeXM3UzF0cmU0dWJyQ3c4VEZ4c2ZJeWNyUzA5VFYxdGZZMmRyaDR1UGs1ZWJuNk9ucThmTHo5UFgyOS9qNSt2L0VBQjhCQUFNQkFRRUJBUUVCQVFFQUFBQUFBQUFCQWdNRUJRWUhDQWtLQy8vRUFMVVJBQUlCQWdRRUF3UUhCUVFFQUFFQ2R3QUJBZ01SQkFVaE1RWVNRVkVIWVhFVElqS0JDQlJDa2FHeHdRa2pNMUx3RldKeTBRb1dKRFRoSmZFWEdCa2FKaWNvS1NvMU5qYzRPVHBEUkVWR1IwaEpTbE5VVlZaWFdGbGFZMlJsWm1kb2FXcHpkSFYyZDNoNWVvS0RoSVdHaDRpSmlwS1RsSldXbDVpWm1xS2pwS1dtcDZpcHFyS3p0TFcydDdpNXVzTER4TVhHeDhqSnl0TFQxTlhXMTlqWjJ1TGo1T1htNStqcDZ2THo5UFgyOS9qNSt2L2FBQXdEQVFBQ0VRTVJBRDhBKy9yL0FGYTVONEVVL0xtcDMxYTVTZUpGUDFxU0MyamE4Sks1K3RGeENuMjRISGFuYlM1TjliRnhOWG15QUd6VTlucWtyM0FEUFdWS1BMR1Y0NXAxbXgzaHUrYVJSLy9aIj4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w"
        onload="window.requestAnimationFrame(function(){
        if(!(size=getBoundingClientRect().width))return;
        onload=null;
        sizes=Math.ceil(size/window.innerWidth*100)+'vw';
        });"
        sizes="73vw" src="http://emarket.test/storage/1/conversions/1-galary.jpg" width="922" height="351"> --}}
</div>


@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('photoGalleryApp', () => ({
                currentPhoto: 0,
                photos: @json($galaries->map(fn($item) => $item->getSrcset('galary'))),
                init() {
                    this.changePhoto();
                },
                nextPhoto() {
                    if (this.hasNext()) {
                        this.currentPhoto++;
                        this.changePhoto();
                    }
                },
                previousPhoto() {
                    if (this.hasPrevious()) {
                        this.currentPhoto--;
                        this.changePhoto();
                    }
                },
                changePhoto() {
                    this.$refs.mainImage.srcset = this.photos[this.currentPhoto];
                },
                pickPhoto(index) {
                    console.log('pick photo', index);
                    this.currentPhoto = index;
                    this.changePhoto();
                },
                hasPrevious() {
                    return this.currentPhoto > 0;
                },
                hasNext() {
                    return this.photos.length > (this.currentPhoto + 1);
                }
            }))
        })
    </script>
@endpush
