<div>
    <x-category-product-link :category="$category"/>

    <div class="grid grid-cols-10">
        <div class="col-span-2">
            <x-aside-categories :categories="$category->children"/>
        </div>
        <div class="col-span-8">
            <!--  MAIN SECTION  -->
            <section class="pt-5">
                <div class="mx-auto px-4">
                    <article class="p-4 bg-white border border-gray-200 shadow-sm rounded-md">
                        <div class="flex flex-col md:flex-row">
                            <main class="md:w-3/4 flex-auto">
                                <!-- banner-main -->
                                <article class="bg-blue-500 p-6 lg:p-16 rounded w-full h-full">
                                    <h1 class="text-3xl md:text-4xl text-white font-semibold">
                                        Best products &amp; <br>brands in our store
                                    </h1>
                                    <p class="text-lg text-white font-normal mt-4 mb-6">
                                        Trendy Products, Factory Prices, Excellent Service
                                    </p>
                                    <div>
                                        <a class="px-4 py-2 inline-block font-semibold bg-yellow-500 text-white border border-transparent rounded-md hover:bg-yellow-600"
                                            href="#">
                                            Discover
                                        </a>
                                        <a class="px-4 py-2 inline-block font-semibold text-blue-600 border border-transparent rounded-md hover:bg-gray-100 bg-white"
                                            href="#">
                                            Learn more
                                        </a>
                                    </div>
                                </article>
                                <!-- banner-main end// -->
                            </main>
                        </div> <!-- grid.// -->
                    </article>
                </div> <!-- container //end -->
            </section>
            <!--  MAIN SECTION //END -->
    
            <!-- SECTION-CONTENT -->
       
            <!--  SECTION-CONTENT  //END -->
        </div>
    </div>
    
</div>
