{{-- <style>
    .sidebar {
        position: sticky;
        top: 0;
        left: 0;
        /* width: 250px; adjust the width to your needs */
        height: 100vh; /* adjust the height to your needs */
        /* background-color: #f0f0f0; adjust the background color to your needs */
        /* padding: 20px; */
        /* border-right: 1px solid #ccc; */
    }
</style> --}}
<div class="sidebar lg:sticky">
    <div class="flex items-center gap-4 px-5 py-3">
        <img
        alt=""
        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
        {{-- src="https://images.unsplash.com/photo-1614644147724-2d4785d69962?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=928&q=80" --}}
        class="size-16 rounded-full object-cover"
        />

        <div class="text-white">
            <div class="flow-root">
                <ul class="-m-1 flex flex-wrap">
                <li class="p-1 leading-none">
                    <a href="#" class="text-xs font-medium text-white"> Hello, </a>
                </li>

                {{-- <li class="p-1 leading-none">
                    <a href="#" class="text-xs font-medium text-black"> GitHub </a>
                </li>

                <li class="p-1 leading-none">
                    <a href="#" class="text-xs font-medium text-black">Website</a>
                </li> --}}
                </ul>
            </div>
        <h3 class="text-lg font-medium text-white">{{ auth()->user()->full_name }}</h3>
        </div>
    </div>
    {{-- <div class="avatar">
        <div class="w-24 rounded-full">
        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
        </div>
    </div> --}}
    {{-- <ul class="menu bg-base-200 rounded-box w-full"> --}}
    <ul class="menu text-white">
        <li class="py-3">
            <a class="hover:bg-base-100 hover:text-black">
            <i class="fa-brands fa-readme"></i>
            Magazine Issues
            </a>
        </li>
        @if(auth()->user()->role === 'customer')
        <li class="py-3">
            <a href="{{ route('categories.businesses') }}" class="{{ request()->routeIs('categories.businesses') ? 'bg-base-100 text-black hover:bg-base-100 hover:text-black' : 'hover:bg-base-100 hover:text-black' }}">
                <i class="fa-solid fa-shop"></i>
                Local Businesses
            </a>
        </li>
        <li class="py-3">
            {{-- <a class="hover:bg-base-100 hover:text-black" href="{{ route('deals') }}"> --}}
            <a href="{{ route('customer.deals.index') }}" class="{{ request()->routeIs('customer.deals.index') ? 'bg-base-100 text-black hover:bg-base-100 hover:text-black' : 'hover:bg-base-100 hover:text-black' }}">
                <i class="fa-solid fa-percent"></i>
                Local Deals
            </a>
        </li>
        <li class="py-3">
        <a class="hover:bg-base-100 hover:text-black">
            <i class="fa-regular fa-star"></i>
            Favorites
        </a>
        </li>
        @elseif(auth()->user()->role === 'business')
        {{-- <li class="py-3">
            <a href="{{ route('dashboard') }}" class="hover:bg-base-100 hover:text-black">
                <i class="fa-solid fa-signs-post"></i>
                Posts
            </a>
        </li> --}}
        <li class="py-3">
            <a href="{{ route('business.deals.index') }}" class="{{ request()->routeIs('business.deals.index') ? 'bg-base-100 text-black hover:bg-base-100 hover:text-black' : 'hover:bg-base-100 hover:text-black' }}">
            {{-- <a class="hover:bg-base-100 hover:text-black"> --}}
                <i class="fa-solid fa-percent"></i>
                Deals
            </a>
        </li>
        @else
        {{-- <li class="py-3">
            <a href="{{ route('dashboard') }}" class="hover:bg-base-100 hover:text-black">
            <i class="fa-solid fa-icons"></i>
            Categories
            </a>
        </li> --}}
        @endif
        <li class="py-3">
            <a href="{{ route('profile.edit') }}" class="hover:bg-base-100 hover:text-black">
                <i class="fa-solid fa-user"></i>
                Profile
            </a>
        </li>
    </ul>
</div>
