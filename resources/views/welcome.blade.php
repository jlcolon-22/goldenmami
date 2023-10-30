@extends('layouts.app')


@section('content')
    <div class="relative w-screen overflow-hidden ">

        {{-- First --}}
        <main id="main" class="
         h-fit  min-w-screen relative overflow-hidden">
            {{-- top --}}
            <section style="background: rgba(255, 255, 255, 0.05) !important">
                <div class=" brightness-100 text-gray-300 w-[85%] mx-auto">
                    <div class="grid grid-cols-2 lg:grid-cols-3  gap-20 h-[35px] items-center  mx-auto  ">
                        <p class="text-sm lg:text-base text-start flex items-center  justify-start">
                            <i class="fa-solid fa-phone-volume"></i>
                            @empty($info->res_number)
                                +63 932 724 9680
                            @else
                                +{{ $info->res_number }}
                            @endempty
                        </p>
                        <p class="text-sm lg:text-base text-end flex items-center gap-1 justify-end lg:justify-center">
                            <i class="fa-solid fa-paper-plane"></i>
                            @empty($info->res_email)
                                goldenmamihouse@gmail.coms
                            @else
                                {{ $info->res_email }}
                            @endempty

                        </p>
                        <p class="text-base text-end hidden lg:block">
                            Open hours: Mon - Sun 10:30 AM - 8 PM
                        </p>
                    </div>
                </div>
            </section>
            {{-- nav --}}
            <section class="  w-full">
                @include('asset.nav')
            </section>
            {{-- quote --}}
            <div class="flex justify-center flex-col min-h-[450px]  w-full items-center ">
                <h2 class="text-5xl sm:text-7xl  font-bold text-[#ebb700]" style="font-family: 'Dancing Script', cursive;">Golden Mami
                </h2>
                <p id="delicious" class="text-[#fff]    overflow-hidden whitespace-nowrap text-6xl sm:text-8xl">DELICIOUS FOOD</p>

            </div>
            {{-- four food --}}
            <div class=" w-full">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-20 h-[200px] items-center w-[85%] mx-auto">
                    <div class="flex flex-col justify-center items-center">
                        <img src="{{ asset('image/s.jpg') }}" class="rounded-full h-[80px] w-[80px]" alt="">
                        <h2 class="text-[#fff] text-center lg:text-left">Grilled Beef with potatoes</h2>
                        <p class="text-[#fff] text-center lg:text-left">Meat, Potatoes, Rice, Tomatoe</p>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <img src="{{ asset('image/6.jpg') }}" class="rounded-full h-[80px] w-[80px]" alt="">
                        <h2 class="text-[#fff] text-center lg:text-left">Grilled Beef with potatoes</h2>
                        <p class="text-[#fff] text-center lg:text-left">Meat, Potatoes, Rice, Tomatoe</p>
                    </div>
                    <div class=" flex-col justify-center items-center hidden sm:flex">
                        <img src="{{ asset('image/1.jpg') }}" class="rounded-full h-[80px] w-[80px]" alt="">
                        <h2 class="text-[#fff] text-center lg:text-left">Grilled Beef with potatoes</h2>
                        <p class="text-[#fff] text-center lg:text-left">Meat, Potatoes, Rice, Tomatoe</p>
                    </div>
                    <div class=" flex-col justify-center items-center hidden lg:flex">
                        <img src="{{ asset('image/5.jpg') }}" class="rounded-full h-[80px] w-[80px]" alt="">
                        <h2 class="text-[#fff]">Grilled Beef with potatoes</h2>
                        <p class="text-[#fff]">Meat, Potatoes, Rice, Tomatoe</p>
                    </div>
                </div>
            </div>
            <div class="b z-0">

                <img src="{{ asset('image/5.jpg') }}"
                    class="absolute left-0 h-full top-0 w-full -z-50 opacity-95 brightness-50" style="object-fit: cover"
                    alt="">
            </div>
        </main>

        {{-- about --}}
        <section>
            <div class="w-[85%] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 py-10 md:py-20">
                    <div class="hidden md:grid grid-cols-2 gap-2">
                        <img src="{{ asset('chef/1.jpg') }}" class="translate-y-6 rounded  h-[500px] -skew-x-6"
                            alt="">
                        <img src="{{ asset('chef/1.jpg') }}" class=" h-[500px] rounded  -skew-x-6" alt="">

                    </div>
                    <div>

                        <h2 class="text-6xl md:text-9xl font-bold text-left md:text-center text-[#ebb700] "
                            style="font-family: 'Dancing Script', cursive;">About</h2>

                        <p class="text-base text-left font-sans w-full  p-10 break-all">Golden Mami House is a Family owned
                            business that was founded in 2011. We're dedicated to providing scrumptious Chinese food that
                            leaves clients with a satisfied expression and makes them want to return!</p>
                        <h3 class="text-3xl pl-10 ">Mon-Sun 10:30 AM - 8 PM</h3>
                        <h3 class="text-6xl pl-10 text-blue-500 "> +63 932 724 9680</h3>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section>
            <div class="w-[85%] mx-auto">
                <div class="grid grid-cols-2 py-20">
                    <div class="grid grid-cols-2 gap-2">
                        <img src="{{ asset('chef/1.jpg') }}" class="translate-y-6 rounded  h-[500px] -skew-x-6"
                            alt="">
                        <img src="{{ asset('chef/1.jpg') }}" class=" h-[500px] rounded  -skew-x-6" alt="">

                    </div>
                    <div>

                        <h2 class=" text-9xl font-bold text-center text-[#ebb700] "
                            style="font-family: 'Dancing Script', cursive;">About</h2>

                        <p class="text-base text-left font-sans w-[70%] p-10 break-all">Golden Mami House is a Family owned
                            business that was founded in 2011. We're dedicated to providing scrumptious Chinese food that
                            leaves clients with a satisfied expression and makes them want to return!</p>
                        <h3 class="text-3xl pl-10 ">Mon-Sun 10:30 AM - 8 PM</h3>
                        <h3 class="text-6xl pl-10 text-blue-500 "> +63 932 724 9680</h3>
                    </div>
                </div>
            </div>
        </section> --}}
        {{-- menu --}}
        <home-frontend auth="{{Auth::guard('customer')->check() ? '1' : '0'}}"></home-frontend>
        <section>
            <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3330.2268499293796!2d120.33237707439051!3d16.039311140239644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33915d57333cdcbb%3A0xcf0c8ca31ac88975!2sGolden%20Mami%20House!5e1!3m2!1sen!2sph!4v1698584151210!5m2!1sen!2sph" class="w-full h-[400px]" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        {{-- footer --}}
        <footer class="bg-[#121212] p-3 text-center">
            <p class="text-gray-100">2023.Golden Mami.All rights reserved</p>

        </footer>
    </div>
@endsection
@section('scripts')

    @if(Auth::guard('customer')->check())
    <script>
        localStorage.setItem('auth',true)
    </script>
    @endif
    <script>

        function menu() {
            document.querySelector('.menuSlide').classList.toggle('hidden');
            document.querySelector('.menuSlide').classList.toggle('flex');
        }

        function profile() {
            document.querySelector('#profileDropdown').classList.toggle('hidden');
        }
        function profileMobile() {
            document.querySelector('#profileDropdownMobile').classList.toggle('hidden');
        }
        function cartMobile() {
            document.querySelectorAll('.cartDropDown')[1].classList.toggle('hidden');

        }
        function cart() {
            document.querySelector('.cartDropDown').classList.toggle('hidden');

        }

        const main = document.querySelector('#main');

        const animate = new IntersectionObserver(entries => {
            entries.forEach(element => {
                const delicious = document.querySelector('#delicious');

                if (element.isIntersecting) {
                    delicious.classList.add('animate-type')
                } else {
                    delicious.classList.remove('animate-type')
                }
            });
        })
        animate.observe(main)
    </script>

@endsection
