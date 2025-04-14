<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Libraries -->
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/front.css'])
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>



    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <main>
        <nav class="container relative my-4 lg:my-10">
            <div class="flex flex-col justify-between w-full lg:flex-row lg:items-center">
                <!-- Logo & Toggler Button here -->
                <div class="flex items-center justify-between">
                    <!-- LOGO -->
                    <a href="{{ route('front.index') }}">
                        <img src="/svgs/logo.svg" alt="stream" />
                    </a>
                    <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
                    <div class="block lg:hidden">
                        <button class="p-1 outline-none mobileMenuButton" id="navbarToggler" data-target="#navigation">
                            <svg class="text-dark w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Nav Menu -->
                <div class="hidden w-full lg:block" id="navigation">
                    <div
                        class="flex flex-col items-baseline gap-4 mt-6 lg:justify-between lg:flex-row lg:items-center lg:mt-0">
                        <div
                            class="flex flex-col w-full ml-auto lg:w-auto gap-4 lg:gap-[50px] lg:items-center lg:flex-row">
                            <a href="{{ route('front.index') }}#hero" class="nav-link-item">Home</a>
                            <a href="{{ route('front.catalog') }}" class="nav-link-item">Car Catalogue</a>
                            <a href="{{ route('front.benefits') }}" class="nav-link-item">Benefits</a>
                            <a href="{{ route('front.transaction') }}" class="nav-link-item">Transaction</a>
                            <!-- <a href="#!" class="nav-link-item">Maps</a> -->
                        </div>
                        @auth
                            <div x-data="{ open: false }" class="relative ml-auto w-full lg:w-auto">
                                <button @click="open = !open"
                                    class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:text-blue-600 transition-all">
                                    <span class="font-medium hidden sm:inline">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown -->
                                <div x-show="open" @click.away="open = false" x-transition
                                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">
                                    <div class="px-4 py-3 text-sm text-gray-700 border-b">{{ Auth::user()->email }}</div>
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="ml-auto">
                                <a href="{{ route('login') }}" class="btn-secondary">
                                    Log In
                                </a>
                            </div>
                        @endauth


                    </div>
                </div>
            </div>
        </nav>

        {{ $slot }}
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 300,
            easing: 'ease-out'
        });
    </script>

    <script src="{{ url('js/script.js') }}"></script>
    <script>
        $('#checkoutButton').click(function (e) {
          e.preventDefault();

          const form = $('#checkoutForm');
          const formData = form.serialize();

          $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function (response) {
              if (response.snapToken) {
                snap.pay(response.snapToken, {
                  onSuccess: function(result){
                    window.location.href = '/payment/success';
                  },
                  onPending: function(result){
                    window.location.href = '/payment/success';
                  },
                  onError: function(result){
                    alert('Payment failed!');
                  },
                  onClose: function(){
                    alert('You closed the payment popup without finishing.');
                  }
                });
              }
            },
            error: function (xhr) {
              alert('Something went wrong. Please try again.');
            }
          });
        });
      </script>


</body>

</html>
