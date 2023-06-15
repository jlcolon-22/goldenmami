<aside class="min-w-[270px] max-w-[270px] bg-white shadow min-h-screen">
    <div class="flex items-center justify-center w-full">
        <img src="/logo/logo.png" class="w-[47px]" alt="">
        <span class="text-[#ebb700]  text-4xl font-bold font-inter" >ADMIN</span>
    </div>
    <ul class="px-4 py-10 grid grid-cols-1 ">
        <li>
            <a href="/admin/dashboard" class="p-2 text-base w-full gap-2 items-center  rounded tracking-wider flex font-inter {{ request()->is('admin/dashboard') ? ' text-gray-700  font-bold' : 'opacity-60'}}"  ><img src="{{asset('svg/home.svg')}}" alt=""> Dashboard</a>
        </li>
        <li>
            <a href="/admin/customers" class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold hover:opacity-100 tracking-wider flex font-inter {{ request()->is('admin/customers') ? ' text-gray-700  font-bold' : 'opacity-60'}}"  ><img src="{{asset('svg/customers.svg')}}" alt=""> Customers</a>
        </li>
        <li>
            <a onclick="employee()" class="p-2 cursor-pointer relative text-base w-full flex gap-2 text-gray-700 rounded  tracking-wider  hover:opacity-100 hover:font-bold font-inter {{ request()->is('admin/employees') || request()->is('admin/attendance')  || request()->is('admin/employee/attendance') ? ' opacity-100 font-bold' : 'opacity-60 '}}" ><img src="{{asset('svg/employee.svg')}}" alt=""> Employee<i class="fa-solid fa-caret-down absolute right-0 top-[28%] bottom-0 "></i>
            </a>
            <ul id="employeeDropdown" class="px-4  bg-gray-200 {{ request()->is('admin/employees') || request()->is('admin/attendance') || request()->is('admin/employee/type') || request()->is('admin/employee/attendance') ? '' : ' hidden'}}">
                <li>
                    <a href="/admin/employees" class="p-2 text-base w-full gap-2 items-center  rounded  tracking-wider hover:opacity-100 hover:font-bold flex  font-inter {{ request()->is('admin/employees') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Employee</a>
                </li>
                <li>
                    <a href="/admin/employee/attendance" class="p-2 text-base w-full gap-2 items-center  rounded hover:font-bold tracking-wider hover:opacity-100 flex {{ request()->is('admin/employee/attendance') ? ' text-gray-700  font-bold' : 'opacity-60'}} font-inter" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Attendance</a>
                </li>
                <li>
                    <a href="/admin/employee/type" class="p-2 text-base w-full gap-2 items-center  rounded  tracking-wider hover:opacity-100 hover:font-bold flex  font-inter {{ request()->is('admin/employee/type') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Employee type</a>
                </li>





            </ul>
        </li>
        <li>
            <a href="/admin/event" class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold hover:opacity-100 tracking-wider flex font-inter {{ request()->is('admin/event') ? ' text-gray-700  font-bold' : 'opacity-60'}}"  ><img src="{{asset('svg/event.svg')}}" class="max-w-[20px] max-h-[20px]" alt=""> Event</a>
        </li>
        <li>
            <a onclick="inventory()" class="p-2 cursor-pointer relative text-base w-full flex gap-2 text-gray-700 rounded hover:font-bold tracking-wider hover:opacity-100 font-inter {{ request()->is('admin/inventory/calasiao') || request()->is('admin/inventory/dagupan') || request()->is('admin/inventory/lingayen') || request()->is('admin/inventory/category') ? 'font-bold' : ' opacity-60'}}" ><img src="{{asset('svg/inventory.svg')}}" alt=""> Inventory<i class="fa-solid fa-caret-down absolute right-0 top-[28%] bottom-0 "></i>
            </a>
            <ul id="inventoryDropdown" class="px-4  bg-gray-200 {{ request()->is('admin/inventory/calasiao') || request()->is('admin/inventory/dagupan') || request()->is('admin/inventory/lingayen') || request()->is('admin/inventory/category') ? '' : ' hidden'}}">
                <li>
                    <a href="/admin/inventory/calasiao" class="p-2 text-base w-full gap-2 items-center text-gray-700 rounded hover:font-bold tracking-wider hover:opacity-100 flex  font-inter  {{ request()->is('admin/inventory/calasiao') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Calasiao</a>
                </li>
                <li>
                    <a href="/admin/inventory/dagupan" class="p-2 text-base w-full gap-2 items-center text-gray-700 rounded hover:font-bold tracking-wider hover:opacity-100 flex  font-inter {{ request()->is('admin/inventory/dagupan') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Dagupan</a>
                </li>
                <li>
                    <a href="/admin/inventory/lingayen" class="p-2 text-base w-full gap-2 items-center text-gray-700 rounded hover:font-bold tracking-wider hover:opacity-100 flex font-inter {{ request()->is('admin/inventory/lingayen') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Lingayen</a>
                </li>
                <li>
                    <a href="/admin/inventory/category" class="p-2 text-base w-full gap-2 items-center text-gray-700 rounded hover:font-bold tracking-wider hover:opacity-100 flex font-inter {{ request()->is('admin/inventory/category') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Item Category</a>
                </li>





            </ul>
        </li>
        <li>
            <a onclick="menu()" class="p-2 cursor-pointer relative text-base w-full flex gap-2 text-gray-700 rounded hover:font-bold tracking-wider hover:opacity-100 {{ request()->is('admin/menu/category') || request()->is('admin/menu') ? ' opacity-100 font-bold' : 'opacity-60 '}} font-inter" ><img src="{{asset('svg/res_menu.svg')}}" alt=""> Menu<i class="fa-solid fa-caret-down absolute right-0 top-[28%] bottom-0 "></i>
            </a>
            <ul id="menuDropdown" class="px-4  bg-gray-200 {{ request()->is('admin/menu/category') || request()->is('admin/menu') ? 'opacity-100' : 'opacity-60 hidden'}} ">
                <li>
                    <a href="/admin/menu" class="p-2 text-base w-full gap-2 items-center rounded hover:font-bold tracking-wider hover:opacity-100 flex  font-inter {{ request()->is('admin/menu') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Menus</a>
                </li>
                <li>
                    <a href="/admin/menu/category" class="p-2 text-base w-full gap-2 items-center  rounded hover:font-bold tracking-wider hover:opacity-100 flex  font-inter {{ request()->is('admin/menu/category') ? ' text-gray-700  font-bold' : 'opacity-60'}}" ><img src="{{asset('svg/bullet.svg')}}" alt=""> Category</a>
                </li>






            </ul>
        </li>

        <li>
            <a href="/admin/reservation" class="p-2 text-base w-full gap-2 items-center text-gray-800 rounded hover:font-bold hover:opacity-100 tracking-wider flex font-inter {{ request()->is('admin/reservation') ? ' text-gray-700  font-bold' : 'opacity-60'}}"  ><img src="{{asset('svg/reserve.svg')}}" alt=""> Reservation</a>
        </li>



    </ul>
</aside>
