<div>
    <!--  PAGE HEADER -->
    <section class="py-5 sm:py-7 bg-blue-100">
        <div class="container max-w-screen-xl mx-auto px-4">
            <!-- breadcrumbs start -->
            <h2 class="text-3xl font-semibold mb-2">Shopping cart</h2>

        </div><!-- /.container -->
    </section>
    <!--  PAGE HEADER .//END  -->

    <section class="py-10">
        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="flex flex-col md:flex-row gap-4">
                <main class="md:w-3/4">

                    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">
                        @foreach ($cart->cartItems as $item)
                            <!-- item-cart -->
                            <div class="flex flex-wrap lg:flex-row gap-5  mb-4">
                                <div class="w-full lg:w-2/5 xl:w-2/4">
                                    <figure class="flex leading-5">
                                        <div>
                                            <div class="block w-16 h-16 rounded border border-gray-200 overflow-hidden">
                                                <img src="images/items/1.jpg" alt="Title">
                                            </div>
                                        </div>
                                        <figcaption class="ml-3">
                                            <p><a href="{{route('site.product.show', $item->sku->product)}}" class="hover:text-blue-600">{{$item->name}}</a></p>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="">
                                    <!-- selection -->
                                    <div class="w-24 relative">
                                        <div class="flex justify-center items-center">
                                            <button type="button" class="border border-gray-500 w-7 h-7 flex justify-center items-center"
                                            wire:click="updateCart('{{$item->rowId}}', {{$item->qty - 1}})">-</button>
                                            <input disabled value="{{$item->qty}}" class="w-12 h-7 border border-gray-500 text-center"/>
                                            <button type="button" class="border border-gray-500 w-7 h-7 flex justify-center items-center"
                                                wire:click="updateCart('{{$item->rowId}}', {{$item->qty + 1}})">+</button>
                                        </div>
                                    </div>
                                    <!-- selection .//end -->
                                </div>
                                <div>
                                    <div class="leading-5">
                                        <p class="font-semibold not-italic">{{ $item->price_total }}</p>
                                        <small class="text-gray-400"> {{$item->price_unit}} / per item </small>
                                    </div>
                                </div>
                                <div class="flex-auto">
                                    <div class="float-right">
                                        <a href="#"
                                            class="px-3 py-2 inline-block text-blue-600 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200">
                                            <i class="fa fa-heart"></i> </a>
                                        <a class="px-4 py-2 inline-block text-red-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100"
                                            href="#"> Remove </a>
                                    </div>
                                </div>
                            </div> <!-- item-cart end// -->

                            <hr class="my-4">
                        @endforeach

                        <h6 class="font-bold">Free Delivery within 1-2 weeks</h6>
                        <p class="text-gray-400">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip</p>

                    </article> <!-- card end.// -->

                </main>
                <aside class="md:w-1/4">

                    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">

                        <ul class="mb-5">
                            <li class="flex justify-between text-gray-600  mb-1">
                                <span>Total price:</span>
                                <span>{{ $cart->priceTotal() }}</span>
                            </li>
                            <li class="flex justify-between text-gray-600  mb-1">
                                <span>Discount:</span>
                                <span class="text-green-500">- đ0</span>
                            </li>
                            <li class="text-lg font-bold border-t flex justify-between mt-3 pt-3">
                                <span>Total price:</span>
                                <span>$420.00</span>
                            </li>
                        </ul>

                        <a class="px-4 py-3 mb-2 inline-block text-lg w-full text-center font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700"
                            href="#"> Checkout </a>

                        <a class="px-4 py-3 inline-block text-lg w-full text-center font-medium text-green-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100"
                            href="#"> Back to shop </a>

                    </article> <!-- card end.// -->

                </aside> <!-- col.// -->
            </div> <!-- grid.// -->

        </div>
    </section>

    <!-- SECTION-RECOMMENDED -->
    <section class="pt-10 pb-20 bg-gray-100">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-8">Recommended products</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div>
                    <!-- COMPONENT: PRODUCT CARD -->
                    <article class="shadow-sm rounded bg-white border border-gray-200">
                        <a href="#" class="relative block p-1">
                            <img src="images/items/14.jpg" class="mx-auto w-auto" style="height: 250px" height="250"
                                alt="Product title here">
                        </a>
                        <div class="p-4 border-t border-t-gray-200">
                            <h6>
                                <a href="#" class="text-gray-600 hover:text-blue-500">Product name goes here</a>
                            </h6>
                            <p class="text-sm text-gray-400">Sizes: S, M, XL</p>
                            <span class="font-semibold">$76.00</span>
                        </div>
                    </article>
                    <!-- COMPONENT: PRODUCT CARD //END -->
                </div>
                <div>
                    <!-- COMPONENT: PRODUCT CARD -->
                    <article class="shadow-sm rounded bg-white border border-gray-200">
                        <a href="#" class="relative block p-1">
                            <img src="images/items/12.jpg" class="mx-auto w-auto" style="height: 250px" height="250"
                                alt="Product title here">
                        </a>
                        <div class="p-4 border-t border-t-gray-200">
                            <h6>
                                <a href="#" class="text-gray-600 hover:text-blue-500">Product name goes here</a>
                            </h6>
                            <p class="text-sm text-gray-400">Sizes: S, M, XL</p>
                            <span class="font-semibold">$76.00</span>
                        </div>
                    </article>
                    <!-- COMPONENT: PRODUCT CARD //END -->
                </div>
                <div>
                    <!-- COMPONENT: PRODUCT CARD -->
                    <article class="shadow-sm rounded bg-white border border-gray-200">
                        <a href="#" class="relative block p-1">
                            <img src="images/items/9.jpg" class="mx-auto w-auto" style="height: 250px" height="250"
                                alt="Product title here">
                        </a>
                        <div class="p-4 border-t border-t-gray-200">
                            <h6>
                                <a href="#" class="text-gray-600 hover:text-blue-500">Product name goes here</a>
                            </h6>
                            <p class="text-sm text-gray-400">Sizes: S, M, XL</p>
                            <span class="font-semibold">$76.00</span>
                        </div>
                    </article>
                    <!-- COMPONENT: PRODUCT CARD //END -->
                </div>
                <div>
                    <!-- COMPONENT: PRODUCT CARD -->
                    <article class="shadow-sm rounded bg-white border border-gray-200">
                        <a href="#" class="relative block p-1">
                            <img src="images/items/8.jpg" class="mx-auto w-auto" style="height: 250px" height="250"
                                alt="Product title here">
                        </a>
                        <div class="p-4 border-t border-t-gray-200">
                            <h6>
                                <a href="#" class="text-gray-600 hover:text-blue-500">Product name goes here</a>
                            </h6>
                            <p class="text-sm text-gray-400">Sizes: S, M, XL</p>
                            <span class="font-semibold">$76.00</span>
                        </div>
                    </article>
                    <!-- COMPONENT: PRODUCT CARD //END -->
                </div>
            </div> <!-- grid .// -->
        </div>
    </section>
    <!--  SECTION-RECOMMENDED  //END -->
</div>
