@extends('layouts.app')


@section('content')
    <div class="relative w-screen overflow-hidden ">
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
            <section class="absolute top-[50px]  w-full">
                @include('asset.nav')
            </section>




        </main>
        <div class=" -z-10  absolute top-0  left-0 w-full h-full ">

            <img src="{{ asset('image/1.jpg') }}" class="  -z-50 brightness-50 object-cover h-full w-full"
                style="object-fit: cover" alt="">
            {{-- <h1>dsad</h1> --}}
        </div>
        <section class="flex justify-center flex-col items-center w-full pt-36 pb-10 min-h-[calc(100vh-40px)]   ">
            <div class="w-[95%] sm:w-[85%] mx-auto flex justify-center ">
                <div class="bg-white p-3 rounded " style="width: 900px;">
                    <div class="flex justify-center -translate-y-8">
                        <h1 class="bg-[#012890] px-5 py-2 w-fit font-inter text-lg font-semibold text-gray-50 rounded-3xl">
                            Frequently Asked Questions</h1>
                    </div>
                    <div class="grid grid-cols-1 gap-y-3 px-6">
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn">
                                <span class="flex items-center text-left text-lg font-inter font-semibold gap-2">
                                    <img src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">
                                    Can I text or email my reservations?
                                </span>

                                <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt="">
                            </button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                Yes, Golden Mami House's contact number and email address can be found on the <a
                                    href="/" class="text-blue-500  font-inter">homepage</a>.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">What do
                                    you serve? </span> <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                The restaurant serves Chinese cuisine.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-left text-lg font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">What
                                    happens if I don't reconfirm my booking?</span> <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                Don't worry, the restaurant will still hold your booking without a reconfirmation.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">I'm sure
                                    I've booked, but I haven't had confirmation - what now?</span> <img
                                    src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                The Golden Mami House's Management will always send you an automated confirmation when your
                                booking is confirmed at the restaurant. If you haven't received a confirmation, please start
                                the process again. If you continue to have an issue, please give us a call or message us
                                during business hours and we'll be in touch to resolve the issue.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">What
                                    happens if I'm running late?</span> <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                Call the restaurant to resolve the issue.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">What
                                    happens if I get to the restaurant, and they don't have my booking? </span> <img
                                    src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                Golden Mami House is committed to honour any confirmed bookings we have generated.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">How do I
                                    cancel a booking? </span> <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                To help our restaurants manage their sittings we ask our diners to give at least 24 hours'
                                notice of any cancellations. You can do this by calling the restaurant direct.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">Why
                                    do you need my email address? </span> <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                The customers’ bookings are automatically confirmed via email. Without an address to send
                                the confirmation to the booking can't be accepted. We'll also use your email address to send
                                reminders for any bookings made more than 24 hours in advance of your dining date.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">Are
                                    you open on holidays?</span> <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                The restaurant will be open for the holiday but expect hours to be limited.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">Can
                                    you accommodate a large group of people?</span> <img
                                    src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                Yes, the restaurant is spacious, and it can be used for some special occasions like birthday
                                parties or wedding receptions.</p>
                            <hr class="text-black mt-3">
                        </div>
                        <div>
                            <button onclick="show(this,0)"
                                class="flex gap-2 items-center justify-between  w-full  questionBtn"><span
                                    class="flex items-center text-lg text-left font-inter font-semibold gap-2"><img
                                        src="{{ asset('svg/help.png') }}" class="w-[20px] h-[20px]" alt="">Can
                                    we bring cake in the restaurant?</span> <img src="{{ asset('svg/arrow.svg') }}"
                                    class="-rotate-90 w-[23px] transition-all ease-in-out " alt=""></button>
                            <p
                                class="font-inter text-gray-600 text-sm py-2 px-12 hidden textBtn transition-all ease-in-out opacity-0 duration-1000">
                                Yes, you can bring your own cake in the restaurant.</p>
                            <hr class="text-black mt-3">
                        </div>


                    </div>
                </div>
            </div>
        </section>
        {{-- footer --}}
        <footer class="bg-[#121212] p-3 text-center w-full  ">
            <p class="text-gray-100">2023.Golden Mami.All rights reserved</p>
        </footer>



    </div>
@endsection
@section('scripts')
    <script>
        document.title = "Frequently Asked Questions "

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

        const textBtn = document.querySelectorAll('.textBtn');
        const show = (e, x) => {



            // textBtn.forEach(element => {
            // element.classList.add('hidden');
            //  });
            e.lastChild.classList.toggle('-rotate-90')
            e.lastChild.classList.toggle('rotate-0')
            console.log()
            e.parentElement.children[1].classList.toggle('hidden')
            e.parentElement.children[1].classList.toggle('opacity-0')
            e.parentElement.children[1].classList.toggle('animate-opacity')


        }
    </script>
@endsection
