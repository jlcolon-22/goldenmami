@extends('layouts.app')


@section('content')
    <div class="bg-[#f9fbfd] w-screen overflow-x-hidden flex">
        @include('asset.adminAside')

        {{-- main --}}
        <main class="overflow-hidden " style="min-width: calc(100vw - 270px);max-width: calc(100vw - 270px)">
            @include('asset.adminNav')

            <section class="p-6">

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

                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span
                                        class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Events</span>
                                </div>
                            </li>
                        </ol>
                    </nav>


                    <event-events></event-events>


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
        document.title = "Event"
    </script>
@endsection
