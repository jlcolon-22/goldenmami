<nav class="w-[85%] mx-auto flex justify-between items-center ">

    <div>
        <a href="/" class="flex items-center"><img src="/logo/logo.png" class="w-[47px]" alt=""><span
                class="text-[#ebb700] text-2xl font-bold">Golden Mami</span></a>
    </div>
    <div class="flex items-center gap-5  lg:block">

        @if (Auth::guard('customer')->check())
        <cart-frontend class="block lg:hidden"></cart-frontend>
            <li class="block lg:hidden">
                <button class="relative" onclick="profileMobile()">
                @empty(Auth::guard('customer')->user()->photo)
                    <img src="{{ url('https://eu.ui-avatars.com/api/?background=random&name=' . Auth::guard('customer')->user()->nickname) }}"
                        class="w-[40px] h-[40px] rounded-full" alt="">
                @else
                    <img src="{{ asset('storage/customer/' . Auth::guard('customer')->user()->photo) }}"
                        class="w-[40px] h-[40px] rounded-full" alt="">
                @endempty
                <div id="profileDropdownMobile"
                    class="z-50 grid-cols-1 gap-3 bg-white p-3 w-[210px] border shadow-2xl absolute left-auto top-14 right-0 lg:right-0 bottom-auto transition-all ease-in-out  hidden">
                    <ul class="">
                        <li>
                            <a href="/my"
                                class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                    src="{{ asset('svg/profile.svg') }}" alt=""> Profile</a>
                        </li>
                        <li>
                            <a href="/reservation/list"
                                class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                    src="{{ asset('svg/setting.svg') }}" alt="">My Reservation</a>
                        </li>

                    </ul>
                    <hr>
                    <ul class="  ">
                        <li>
                            <a onclick="localStorage.removeItem('auth')" href="/logout"
                                class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                    src="{{ asset('svg/logout.svg') }}" alt=""> Logout</a>
                        </li>

                    </ul>
                </div>
            </button>

        </li>

    @endif
        <button onclick="menu()" class="block lg:hidden"><img src="{{asset('svg/menu.svg')}}" alt=""></button>
    </div>
    <ul class="  menuSlide bg-[#000000fd] hidden fixed h-screen z-50 flex-col items-start p-7 gap-4 top-0 left-0 w-full lg:w-fit  lg:flex lg:gap-10 lg:item-center lg:flex-row lg:bg-transparent lg:relative lg:h-fit">
        <li><a href="/"
                class=" text-lg font-normal  tracking-wider {{ request()->is('/') ? 'text-[#ebb700]' : 'text-[#fff]' }}">Home</a>
        </li>
        <li><a href="/menu"
                class="text-lg font-normal tracking-wider {{ request()->is('menu') ? 'text-[#ebb700]' : 'text-[#fff]' }}">Menu</a>
        </li>
        <li><a href="/reservation"
                class=" text-lg font-normal tracking-wider {{ request()->is('reservation') ? 'text-[#ebb700]' : 'text-[#fff]' }}">Reservation</a>
        </li>
        <li><a href="/faq"
            class=" text-lg font-normal tracking-wider {{ request()->is('faq') ? 'text-[#ebb700]' : 'text-[#fff]' }}">FAQ's</a>
    </li>
    <li class="absolute top-8 right-5"><button onclick="menu()" class="block lg:hidden "><img src="{{asset('svg/exit.btn.svg')}}" alt=""></button></li>
        <li><a href="/contact"
                class=" text-lg font-normal tracking-wider {{ request()->is('contact') ? 'text-[#ebb700]' : 'text-[#fff]' }}">Contact</a>
        </li>
        <cart-frontend class="hidden lg:block"></cart-frontend>
        @if (Auth::guard('customer')->check())
            <li class="hidden lg:block">
                <button class="relative" onclick="profile()">
                @empty(Auth::guard('customer')->user()->photo)
                    <img src="{{ url('https://eu.ui-avatars.com/api/?background=random&name=' . Auth::guard('customer')->user()->nickname) }}"
                        class="w-[40px] h-[40px] rounded-full" alt="">
                @else
                    <img src="{{ asset('storage/customer/' . Auth::guard('customer')->user()->photo) }}"
                        class="w-[40px] h-[40px] rounded-full" alt="">
                @endempty
                <div id="profileDropdown"
                    class="z-50 grid-cols-1 gap-3 bg-white p-3 w-[210px] border shadow-2xl absolute left-auto top-14 right-auto lg:right-0 bottom-auto transition-all ease-in-out  hidden">
                    <ul class="">
                        <li>
                            <a href="/my"
                                class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                    src="{{ asset('svg/profile.svg') }}" alt=""> Profile</a>
                        </li>
                        <li>
                            <a href="/reservation/list"
                                class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                    src="{{ asset('svg/setting.svg') }}" alt="">My Reservation</a>
                        </li>

                    </ul>
                    <hr>
                    <ul class="  ">
                        <li>
                            <a onclick="localStorage.removeItem('auth')" href="/logout"
                                class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter"><img
                                    src="{{ asset('svg/logout.svg') }}" alt=""> Logout</a>
                        </li>

                    </ul>
                </div>
            </button>

        </li>
    @else
        <li class=""><a href="/login"
                class="text-[#fff]  text-lg font-normal bg-blue-400 px-4 py-2 rounded">Login</a></li>
    @endif


</ul>
</nav>
