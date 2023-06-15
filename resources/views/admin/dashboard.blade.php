@extends('layouts.app')


@section('content')
    <div class="bg-[#f9fbfd] w-[100%] max-w-[100%] overflow-hidden flex" >
        @include('asset.adminAside')

        {{-- main --}}
        <main class="overflow-hidden" style="min-width: calc(100vw - 270px);max-width: calc(100vw - 270px)">
            @include('asset.adminNav')
            <section class="p-6 overflow-y-auto" style="max-height: calc(100vh - 60px)">
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



                        </ol>
                    </nav>


                    <Dashboard></Dashboard>

                </div>
            </section>
        </main>
    </div>
@endsection

@section('scripts')
<script>
   function employee(){
    document.querySelector('#employeeDropdown').classList.toggle('hidden');
   }
   function inventory(){
    document.querySelector('#inventoryDropdown').classList.toggle('hidden');
   }
   function profile(){
    document.querySelector('#profileDropdown').classList.toggle('hidden');
    document.querySelector('#profileDropdown').classList.toggle('grid');
   }
   function menu(){
    document.querySelector('#menuDropdown').classList.toggle('hidden');

   }
</script>

@endsection
