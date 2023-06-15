@extends('layouts.app')


@section('content')
    <div class="bg-[#f9fbfd] w-[100%] max-w-[100%] overflow-hidden flex" >
        <aside class="min-w-[270px] max-w-[270px] bg-white shadow min-h-screen">
            <div class="flex items-center justify-center w-full">
                <img src="/logo/logo.png" class="w-[47px]" alt="">
                <span class="text-[#ebb700]  text-4xl font-bold font-inter" >Employee</span>
            </div>
            <ul class="px-4 py-10 grid grid-cols-1 ">
                <li>
                    <a href="/employee/dashboard" class="p-2 text-base w-full gap-2 items-center  rounded tracking-wider flex font-inter {{ request()->is('employee/dashboard') ? ' text-gray-700  font-bold' : 'opacity-60'}}"  ><img src="{{asset('svg/home.svg')}}" alt=""> Dashboard</a>
                </li>
                <li>
                    <a href="/employee/attendance" class="p-2 text-base w-full gap-2 items-center  rounded tracking-wider flex font-inter {{ request()->is('employee/attendance') ? ' text-gray-700  font-bold' : 'opacity-60'}}"  ><img src="{{asset('svg/attendance.svg')}}" alt=""> Attendance</a>
                </li>

            </ul>
        </aside>

        {{-- main --}}
        <main class="overflow-hidden" style="min-width: calc(100vw - 270px);max-width: calc(100vw - 270px)">
            <nav  class="bg-white shadow h-[60px] w-full flex justify-between items-center px-3 pr-5">
                <a class="hover:opacity-70"><img src="{{asset('svg/menu.svg')}}" alt=""></a>
                <div>
                    <button onclick="profile()" class="relative">
                        @if (!!Auth::guard('employee')->user()->photo)
                        <img src="{{'/storage/employee/'.Auth::guard('employee')->user()->photo}}" class="w-[40px] h-[40px] rounded-lg" alt="">
                        @else
                        <img src="{{asset('chef/1.jpg')}}" class="w-[40px] h-[40px] rounded-lg" alt="">
                        @endif
                        <div id="profileDropdown" class="z-50 grid-cols-1 gap-3 bg-white p-3 w-[250px] border shadow-2xl absolute left-auto top-14 right-0 bottom-auto transition-all ease-in-out hidden ">
                            <div class="flex items-center gap-3">
                                <img src="{{asset('chef/1.jpg')}}" class="w-[50px] h-[50px] rounded-lg" alt="">
                                <div>
                                    <h2 class="text-left text-base uppercase font-bold">{{Auth::guard('employee')->user()->firstname.' '.Auth::guard('employee')->user()->lastname}}</h2>
                                    <small class="text-base opacity-70 ">{{Auth::guard('employee')->user()->email}}</small>
                                </div>
                            </div>
                            <hr>
                            <ul  class="">
                                <li>
                                    <a href="/employee/setting" class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter" ><img src="{{asset('svg/setting.svg')}}" alt=""> Setting</a>
                                </li>

                            </ul>
                            <hr>
                            <ul  class="  ">
                                <li>
                                    <a href="/employee/logout" class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter" ><img src="{{asset('svg/logout.svg')}}" alt=""> Logout</a>
                                </li>

                            </ul>
                        </div>
                    </button>
                </div>
            </nav>

            <section class="p-6 overflow-y-hidden" style="max-height: calc(100vh - 60px)">
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


                    <employee-dashboard></employee-dashboard>

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
   document.title = "Employee Dashboard"
</script>

@endsection
