    <!-- start: Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-slate-200 p-4 z-50 sidebar-menu transition-transform">
        <a href="{{ route('home') }}" class="flex justify-center items-center pb-1 border-b border-b-gray-800">
            <img src="{{ asset('image/landing_page/logo.png') }}" alt="" class="w-20 h-20 rounded object-cover ">
        </a>
        <ul class="mt-4 overflow-y-auto h-full pb-24 pt-5 scrollbar-hide">
            <li class="mb-2 group {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mb-2 {{ Request::is('dashboard/profile*') ? 'active' : '' }}">
                <a href="{{ route('my_profile') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-user-fill mr-3 text-lg"></i>
                    <span class="text-sm">My Profile</span>
                </a>
            </li>    
            {{-- <li class="mb-2 group {{ Request::is('dashboard/booking*') ? 'active' : '' }}">
                <a href="{{ route('booking_room') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-hotel-bed-fill mr-3 text-lg"></i>
                    <span class="text-sm">Booking Room</span>
                </a>
            </li>     --}}
            @can('admin')
            <li class="mb-2 group {{ Request::is('dashboard/rooms*') ? 'active' : '' }}">
                <a href="{{ route('rooms.index') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-hotel-bed-fill mr-3 text-lg"></i>
                    <span class="text-sm">Data Rooms</span>
                </a>
            </li>    
            <li class="mb-2 group {{ Request::is('dashboard/categories*') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-inbox-archive-fill mr-3 text-lg"></i>
                    <span class="text-sm">Categories Room</span>
                </a>
            </li>    
            <li class="mb-2 group {{ Request::is('dashboard/users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-user-settings-fill mr-3 text-lg"></i>
                    <span class="text-sm">Data Users</span>
                </a>
            </li>    
            <li class="mb-2 group {{ Request::is('dashboard/roles*') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-admin-fill mr-3 text-lg"></i>
                    <span class="text-sm">Data Roles</span>
                </a>
            </li>    
            @endcan

            @canany(['admin', 'resepsonis'])
            <li class="mb-2 group {{ Request::is('dashboard/data_bookings*') ? 'active' : '' }}">
                <a href="{{ route('bookings.index') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-money-dollar-box-fill mr-3 text-lg"></i>
                    <span class="text-sm">Data Bookings</span>
                </a>
            </li>    
            <li class="mb-2 group {{ Request::is('dashboard/histories*') ? 'active' : '' }}">
                <a href="{{ route('history') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-history-fill mr-3 text-lg"></i>
                    <span class="text-sm">Histories</span>
                </a>
            </li>
            @endcanany
          
            <li class="mb-2 group">
                <a href="{{ route('home') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-home-office-fill mr-3 text-lg"></i>
                    <span class="text-sm">Back Home</span>
                </a>
            </li>
            <li class="mb-2 group">
                <a href="{{ route('list_room') }}" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    <i class="ri-hotel-bed-fill mr-3 text-lg"></i>
                    <span class="text-sm">Booking</span>
                </a>
            </li>
            
            <li class="mb-2 group">
                <form action="{{route('logout')}}" method="POST" class="flex items-center py-2 px-4 text-gray-800 hover:bg-gray-800 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-800 group-[.selected]:text-gray-100">
                    @csrf
                    <i class="ri-logout-box-fill mr-3 text-lg"></i>
                    <button type="submit" onclick="myconfirm(event, 'Are you sure ?')" class="flex items-center h-full w-full text-sm">Log Out</button>
                </form>
            </li>                 
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end: Sidebar -->