@extends('layouts.app')


@section('content')
    <div class="relative w-screen overflow-hidden">
        {{-- First --}}
        <main class="h-fit relative">
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
           <section class=" w-full">
            @include('asset.nav')
           </section>
           {{-- quote --}}
          <div class="flex justify-center flex-col absolute top-[40%] sm:top-1/3 w-full items-center">
                    <h2 class=" text-4xl font-bold text-[#ebb700]" style="font-family: 'Dancing Script', cursive;">Golden Mami</h2>
                    <p class="text-[#fff] text-8xl sm:text-9xl">Our Menu</p>

           </div>

            <div class="" style="height: 330px;overflow: hidden;" class=" z-0  "  >

                <img src="{{asset('goldenmami/5.jpg')}}" style="height: 400px;overflow: hidden;"  class="absolute left-0 object-cover  top-0 w-full -z-50 opacity-95 brightness-50" style="object-fit: cover" alt="">
                {{-- <h1>dsad</h1> --}}
            </div>
        </main>

        {{-- menu --}}
        <section  style="min-height:calc(92.8vh - 435px)">

            <menu-frontend auth="{{Auth::guard('customer')->check() ? '1' : '0'}}"></menu-frontend>
        </section>

        {{-- footer --}}
        <footer class="bg-[#121212] p-3 text-center">
            <p class="text-gray-100">2023.Golden Mami.All rights reserved</p>
        </footer>
    </div>
@endsection
@section('scripts')
    <script>

        function profile()
        {
            document.querySelector('#profileDropdown').classList.toggle('hidden');
        }

        function cart()
        {
            document.querySelector('#cartDropDown').classList.toggle('hidden');

        }
        // mobile
        function menu() {
            document.querySelector('.menuSlide').classList.toggle('hidden');
            document.querySelector('.menuSlide').classList.toggle('flex');
        }
        function profileMobile() {
            document.querySelector('#profileDropdownMobile').classList.toggle('hidden');
        }
        function cartMobile() {
            document.querySelectorAll('.cartDropDown')[1].classList.toggle('hidden');

        }
        document.title = "Menu"
    </script>
@endsection
