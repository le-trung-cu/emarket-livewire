<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Type some info" />
    <meta name="author" content="Type name" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('settings.site_title', 'Laravel') }}</title>

    <!-- Styles -->
    @livewireStyles
    <link href="{{ asset('site/css/app.css') }}" rel="stylesheet" />
    <!-- Font awesome 5 -->
    <link href="{{ asset('fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @wireUiScripts
    @livewireScripts
    <script src="{{ asset('site/js/app.js') }}" defer></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body>
    <x-notifications z-index="z-50" />
    <!--  COMPONENT: HEADER -->
    <header class="bg-white py-3 border-b">
        <div class="container max-w-screen-xl mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <!-- Brand -->
                <div class="flex-shrink-0 mr-5">
                    <a href="{{ route('site.home') }}"> <img src="{{ asset('images/logo.svg') }}" height="38"
                            alt="Brand" /> </a>
                </div>
                <!-- Brand .//end -->

                <!-- Search -->
                <div
                    class="flex flex-nowrap items-center w-full order-last md:order-none mt-5 md:mt-0 md:w-2/4 lg:w-2/4">
                    <input
                        class="flex-grow appearance-none border border-gray-200 bg-gray-100 rounded-md mr-2 py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400"
                        type="text" placeholder="Search">
                    <button type="button"
                        class="px-4 py-2 inline-block border border-transparent bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Search
                    </button>
                </div>
                <!-- Search .//end -->

                <!-- Actions -->
                <div class="flex items-center space-x-2 ml-auto">
                    <a class="px-3 py-2 inline-block text-center text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:border-gray-300"
                        href="#">
                        <i class="text-gray-400 w-5 fa fa-user"></i>
                        <span class="hidden lg:inline ml-1">Sign in</span>
                    </a>

                    <a class="px-3 py-2 inline-block text-center text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:border-gray-300"
                        href="#">
                        <i class="text-gray-400 w-5 fa fa-heart"></i>
                        <span class="hidden lg:inline ml-1">Wishlist</span>
                    </a>

                    <livewire:site.cart-icon />

                </div>
                <!-- Actions .//end -->

                <!-- mobile-only -->
                <div class="lg:hidden ml-2">
                    <button type="button"
                        class="bg-white p-3 inline-flex items-center rounded-md text-black hover:bg-gray-200 hover:text-gray-800 border border-transparent">
                        <span class="sr-only">Open menu</span>
                        <i class="fa fa-bars fa-lg"></i>
                    </button>
                </div>
                <!-- mobile-only //end  -->

            </div> <!-- flex grid //end -->
        </div> <!-- container //end -->
    </header>

    <nav class="relative shadow-sm">
        <div class="container max-w-screen-xl mx-auto px-4">
            <!-- Bottom -->
            <div class="hidden lg:flex flex-1 items-center py-1">
                <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Category </a>
                <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> About </a>
                <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Services </a>
                <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Projects </a>
                <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Offers </a>
                <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Others </a>
            </div>
            <!-- Bottom //end -->
        </div> <!-- container //end -->
    </nav>
    <!--  COMPONENT: HEADER //END -->

    {{ $slot }}
  
    <footer class="bg-blue-600">
        <!-- section footer top -->

        <section class="py-10 text-white">
            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="flex flex-wrap">
                    <aside class="w-full md:w-1/3 lg:w-1/4 mb-5">
                        <img src="{{ asset('images/logo-white.png') }}" height="38" alt="Company name">
                        <p class="my-4">
                            {{config('settings.site_name')}}. <br> © 2018- 2021 Templatemount. <br>
                            All rights reserved.
                        </p>
                    </aside> <!-- col .// -->
                    <aside class="w-1/2 sm:w-auto flex-auto mb-5">
                        <h3 class="font-semibold"> Store </h3>
                        <ul class="mt-2 space-y-1">
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Join us </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Find store </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Categories </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Partnership </a>
                            </li>
                        </ul>
                    </aside> <!-- col .// -->
                    <aside class="w-1/2 sm:w-auto flex-auto mb-5">
                        <h3 class="font-semibold"> About </h3>
                        <ul class="mt-2 space-y-1">
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> About us </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Our history </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Our team </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Offices </a>
                            </li>
                        </ul>
                    </aside> <!-- col .// -->
                    <aside class="w-1/2 sm:w-auto flex-auto  mb-5">
                        <h3 class="font-semibold"> Help </h3>
                        <ul class="mt-2 space-y-1">
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Contact us </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Submit ticket </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> FAQs </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Refunds </a>
                            </li>
                        </ul>
                    </aside> <!-- col .// -->
                    <aside class="w-1/2 sm:w-auto flex-auto  mb-5">
                        <h3 class="font-semibold"> Links </h3>
                        <ul class="mt-2 space-y-1">
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Our terms </a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Privacy setting</a>
                            </li>
                            <li>
                                <a href="#" class="opacity-70 hover:opacity-100"> Sign up </a>
                            </li>
                        </ul>
                    </aside> <!-- col .// -->
                    <aside class="w-1/2 sm:w-auto lg:w-40  mb-5">
                        <h3 class="font-semibold"> Apps </h3>
                        <a href="#" class="mt-3 inline-block">
                            <img class="h-10" src="{{ asset('images/misc/btn-appstore.png') }}" height="38">
                        </a>
                        <a href="#" class="inline-block">
                            <img class="h-10" src="{{ asset('images/misc/btn-market.png') }}" height="38">
                        </a>
                    </aside> <!-- col .// -->
                </div> <!-- grid .// -->
            </div> <!-- container .// -->
        </section>
        <!-- section footer top end -->

        <!-- section footer bottom  -->
        <section class="bg-blue-700 py-6 text-white">
            <div class="container max-w-screen-xl mx-auto px-4">
                <div class="lg:flex justify-between">
                    <div class="mb-3">
                        <img src="{{ asset('images/misc/payments.png') }}" height="24" class="h-6"
                            alt="Payment methods">
                    </div> <!-- col .// -->
                    <div class="space-x-6">
                        <nav class="text-sm space-x-4">
                            <a href="#" class="opacity-70 hover:opacity-100">
                                Support
                            </a>
                            <a href="#" class="opacity-70 hover:opacity-100">
                                Privacy &amp; Cookies
                            </a>
                            <a href="#" class="opacity-70 hover:opacity-100">
                                Accessibility
                            </a>
                        </nav>
                    </div> <!-- col .// -->
                </div> <!-- grid .// -->
            </div> <!-- container .// -->
        </section>
        <!-- section footer bottom  end -->
    </footer>

    @stack('scripts')
</body>

</html>
