<nav  class="bg-white shadow h-[60px] w-full flex justify-between items-center px-3 pr-5">
    <a class="hover:opacity-70"><img src="{{asset('svg/menu.svg')}}" alt=""></a>
    <div>
        <button onclick="profile()" class="relative">
            <img src="{{asset('chef/1.jpg')}}" class="w-[40px] h-[40px] rounded-lg" alt="">
            <div id="profileDropdown" class="z-50 grid-cols-1 gap-3 bg-white p-3 w-[250px] border shadow-2xl absolute left-auto top-14 right-0 bottom-auto transition-all ease-in-out hidden ">
                <div class="flex items-center gap-3">
                    <img src="{{asset('chef/1.jpg')}}" class="w-[50px] h-[50px] rounded-lg" alt="">
                    <div>
                        <h2 class="text-left text-base uppercase font-bold">{{Auth::guard('web')->user()->name}}</h2>
                        <small class="text-base opacity-70 ">{{Auth::guard('web')->user()->email}}</small>
                    </div>
                </div>
                <hr>
                <ul  class="">
                    <li>
                        <a href="/admin/setting" class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter" ><img src="{{asset('svg/setting.svg')}}" alt=""> Setting</a>
                    </li>

                </ul>
                <hr>
                <ul  class="  ">
                    <li>
                        <a href="/admin/logout" class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold tracking-wider hover:opacity-100 flex opacity-70 font-inter" ><img src="{{asset('svg/logout.svg')}}" alt=""> Logout</a>
                    </li>

                </ul>
            </div>
        </button>
    </div>
</nav>
