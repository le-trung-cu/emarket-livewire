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
                <main x-data="productVariantionApp">
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

                    <p class="mb-4 font-semibold text-xl" x-text="selectedSku.price">{{ $sku->price_vnd }}</p>

                    <p class="mb-4 text-gray-500">
                        Virgil Abloh’s Off-White is a streetwear-inspired collection that
                        continues to break away from the conventions of mainstream fashion. Made in Italy, these black
                        and brown Odsy-1000 low-top sneakers.
                    </p>

                    <div class="mb-4">
                        <!-- select-custom -->
                        <template x-for="(option, optionIndex) in options" :key="option.id">
                            <div class="flex flex-wrap space-x-3">
                                <span class="font-medium inline-block capitalize w-36" x-text="option.name"></span>
                                <template x-for="value in option.values" :key="value.id">
                                    <label :class="{' mx-2 inline-block cursor-pointer': true, 'text-gray-400' : !optionValueEnabled[optionIndex].has(value.id)}">
                                        <input  type="radio" x-model="selectedValueIds[optionIndex]"
                                            :value="value.id" :name="`selectedValueIds[${optionIndex}]`"
                                            @change="optionChange(optionIndex, value.id)"
                                            :disabled="!optionValueEnabled[optionIndex].has(value.id)" />
                                        <span x-text="value.value"></span>
                                    </label>
                                </template>
                            </div>
                        </template>
                         <!-- select-custom .//end -->
                    </div>
                    <!-- action buttons -->
                    <div class="flex flex-wrap gap-2">
                        <a class="px-4 py-2 inline-block text-white bg-yellow-500 border border-transparent rounded-md hover:bg-yellow-600"
                            href="#">
                            Buy now
                        </a>
                        <a class="px-4 py-2 inline-block text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700"
                            href="#" @click.prevent="addToCart(selectedSku.id)">
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
                })),

                Alpine.data('productVariantionApp', () => ({
                    // options: [],
                    options: @js($options),
                    skus: @js((object)$skus),
                    selectedValueIds: [],
                    optionValueEnabled: [],
                    selectedSku: {},
                    variantionValueIds: [],
                    mapVariantionCombinateToSku: {},

                    init() {
                        
                        this.variantionValueIds = Object.values(this.skus).map(sku => sku
                            .variantionValueIds);
                        this.mapVariantionCombinateToSku = Object.keys(this.skus).reduce((result,
                        skuKey) => {
                            const stringCombinate = this.skus[skuKey].variantionValueIds.join('_');
                            result[stringCombinate] = skuKey;
                            return result;
                        }, {});
                        if(this.options.length === 0){
                            this.selectedSku = this.skus[Object.keys(this.skus)[0]];
                            return;
                        }
                        if (this.variantionValueIds.length > 0) {
                            this.optionValueEnabled[0] = new Set(
                                this.variantionValueIds.map(valueIds => valueIds[0])
                            );
                            this.optionChange(0, 1);
                        }
                    },
                    optionChange(optionIndex, valueId) {
                        this.selectedValueIds[optionIndex] = valueId;
                        this.selectedValueIds = [...this.selectedValueIds];
                        console.log(this.selectedValueIds);

                        if (optionIndex + 1 < this.options.length) {
                            const selectedValueIdsLeft = this.selectedValueIds.slice(0, optionIndex + 1);
                            const enables = this.variantionValueIds.filter(valueIds => {
                                return selectedValueIdsLeft.every(id => valueIds.includes(id));
                            });
                            console.log('enables', enables[0]);
                            this.optionValueEnabled[optionIndex + 1] = new Set(
                                enables.map(valueIds => valueIds[optionIndex + 1])
                            );
                            this.optionChange(optionIndex + 1, enables[0][optionIndex + 1])
                        } else {
                            const stringCombinate = this.selectedValueIds.join('_');
                            this.selectedSku = this.skus[this.mapVariantionCombinateToSku[stringCombinate]];
                        }
                    },
                    addToCart(sku) {
                        // livewire component
                        @this.addToCart(sku);
                    }
                }))
        })
    </script>
@endpush
