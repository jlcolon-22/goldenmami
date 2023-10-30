@extends('layouts.app')



@section('content')
    <div class="relative w-screen overflow-hidden">
        {{-- First --}}
        <main class="h-fit w-screen relative">
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


            <div  class=" -z-10  absolute top-0 left-0 w-screen h-screen ">

                <img src="{{ asset('image/1.jpg') }}"
                    class="  -z-50 opacity-95 brightness-50 object-cover h-full w-full"  style="object-fit: cover"
                    alt="">
                {{-- <h1>dsad</h1> --}}
            </div>

        </main>
        <div  class=" -z-10  absolute top-0  left-0 w-full h-full ">

            <img src="{{ asset('image/1.jpg') }}"
                class="  -z-50  brightness-50 object-cover h-full w-full"  style="object-fit: cover"
                alt="">
            {{-- <h1>dsad</h1> --}}
        </div>
        <section class="flex justify-center flex-col items-center w-full pt-16 pb-10 h-[calc(100vh-40px)]   ">
            <div class="w-[85%] mx-auto flex justify-center ">
                <div class="bg-gray-100 ">
                    <h1 class="bg-green-500 text-3xl text-gray-200 p-2">Successfully Created!</h1>
                    <p class="p-2 text-2xl">Please check your gmail to verifify your accout!</p>
                </div>
            </div>
        </section>
              {{-- footer --}}
              <footer class="bg-[#121212] p-3 text-center w-full  ">
                <p class="text-gray-100 ">2023.Golden Mami.All rights reserved</p>
            </footer>


    </div>
@endsection
@section('scripts')
    <script>
          function cart()
        {
            document.querySelector('#cartDropDown').classList.toggle('hidden');

        }
        function menu() {
            document.querySelector('.menuSlide').classList.toggle('hidden');
            document.querySelector('.menuSlide').classList.toggle('flex');
        }
        function profile() {
            document.querySelector('#profileDropdown').classList.toggle('hidden');
        }
         //mobile


        function profileMobile() {
            document.querySelector('#profileDropdownMobile').classList.toggle('hidden');
        }

        function cartMobile() {
            document.querySelectorAll('.cartDropDown')[1].classList.toggle('hidden');

        }
        document.title = "Login"
    </script>
@endsection


