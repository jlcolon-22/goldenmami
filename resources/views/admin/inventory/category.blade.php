@extends('layouts.app')


@section('content')
    <div class="bg-[#f9fbfd] w-screen overflow-x-hidden flex">
        @include('asset.adminAside')

        {{-- main --}}
        <main class="w-full relative">
            <nav class="bg-white shadow w-full h-[60px] flex justify-between items-center px-3">
                <a class="hover:opacity-70"><img src="{{ asset('svg/menu.svg') }}" alt=""></a>
                <div>
                    <button onclick="profile()" class="relative">
                        <img src="{{ asset('chef/1.jpg') }}" class="w-[40px] h-[40px] rounded-lg" alt="">
                        <div id="profileDropdown"
                            class="z-50 grid-cols-1 gap-3 bg-white p-3 w-[250px] border shadow-2xl absolute left-auto top-14 right-0 bottom-auto transition-all ease-in-out hidden ">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('chef/1.jpg') }}" class="w-[50px] h-[50px] rounded-lg" alt="">
                                <div>
                                    <h2 class="text-left text-base uppercase font-bold">
                                        {{ Auth::guard('web')->user()->name }}</h2>
                                    <small class="text-base opacity-70 ">{{ Auth::guard('web')->user()->email }}</small>
                                </div>
                            </div>
                            <hr>
                            <ul class="">
                                <li>
                                    <a href=""
                                        class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                            src="{{ asset('svg/profile.svg') }}" alt=""> Profile</a>
                                </li>
                                <li>
                                    <a href=""
                                        class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                            src="{{ asset('svg/setting.svg') }}" alt=""> Setting</a>
                                </li>

                            </ul>
                            <hr>
                            <ul class="  ">
                                <li>
                                    <a href="/admin/logout"
                                        class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                            src="{{ asset('svg/logout.svg') }}" alt=""> Logout</a>
                                </li>

                            </ul>
                        </div>
                    </button>
                </div>
            </nav>

            <section class="p-6 ">
                <div>

                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="#"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                                    <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>

                            <li>
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="#"
                                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Inventory</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span
                                        class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Calasiao</span>
                                </div>
                            </li>
                        </ol>
                    </nav>


                    <inventory-category></inventory-category>

                </div>
            </section>
        </main>
    </div>
@endsection

@section('scripts')
    <script>
        function employee() {
            document.querySelector('#employeeDropdown').classList.toggle('hidden');
        }

        function inventory() {
            document.querySelector('#inventoryDropdown').classList.toggle('hidden');
        }

        function profile() {
            document.querySelector('#profileDropdown').classList.toggle('hidden');
            document.querySelector('#profileDropdown').classList.toggle('grid');
        }

        function menu() {
            document.querySelector('#menuDropdown').classList.toggle('hidden');

        }
        document.title = "Inventory Item Category"
    </script>
@endsection
