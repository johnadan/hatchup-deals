<div class="p-4 hidden md:block">
  <!-- User Avatar and Name -->
  <div class="flex flex-col items-center mb-8">
    <img
    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
    alt="User Avatar"
    class="w-16 h-16 rounded-full mb-2" />
    <span class="text-lg font-semibold">{{ auth()->user()->full_name }}</span>
  </div>

  <!-- Tabs -->
  <ul>
    @if(auth()->user()->role === 'customer')
    <li class="mb-4">
      <button @click="activeTab = 'businesses'" :class="{'bg-white text-black': activeTab === 'businesses'}" class="w-full text-left p-2 rounded-full hover:bg-white hover:text-black">
      {{-- <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'w-full text-left p-2 rounded-full text-white hover:bg-white hover:text-black' : 'hover:bg-white hover:text-black' }}"> --}}
      {{-- <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'w-full text-left p-2 rounded-full text-white hover:bg-white hover:text-black' : 'hover:bg-white hover:text-black' }}"> --}}
        <i class="fas fa-store mr-2"></i> Local Businesses
      {{-- </a> --}}
      </button>
    </li>
    <li class="mb-4">
      <button @click="activeTab = 'deals'" :class="{'bg-white text-black': activeTab === 'deals'}" class="w-full text-left p-2 rounded-full hover:bg-white hover:text-black">
      {{-- <a href="{{ route('deals') }}" class="{{ request()->routeIs('deals') ? 'w-full text-left p-2 rounded-full text-white hover:bg-white hover:text-black' : 'hover:bg-white hover:text-black' }}"> --}}
      {{-- <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('deals') ? 'w-full text-left p-2 rounded-full text-white hover:bg-white hover:text-black' }}"> --}}
        <i class="fas fa-tags mr-2"></i> Local Deals
      {{-- </a> --}}
      </button>
    </li>
    <li class="mb-4">
      <button @click="activeTab = 'favorites'" :class="{'bg-white text-black': activeTab === 'favorites'}" class="w-full text-left p-2 rounded-full hover:bg-white hover:text-black">
        <i class="fas fa-heart mr-2"></i> Favorites
      </button>
    </li>
    @elseif(auth()->user()->role === 'business')
    <li class="mb-4">
      <button @click="activeTab = 'posts'" :class="{'bg-white text-black': activeTab === 'posts'}" class="w-full text-left p-2 rounded-full hover:bg-white hover:text-black">
        <i class="fas fa-heart mr-2"></i> Posts
      </button>
    </li>
    <li class="mb-4">
      <button @click="activeTab = 'deals'" :class="{'bg-white text-black': activeTab === 'deals'}" class="w-full text-left p-2 rounded-full hover:bg-white hover:text-black">
        <i class="fas fa-heart mr-2"></i> Deals
      </button>
    </li>
    @else
    <li class="mb-4">
      <button @click="activeTab = 'categories'" :class="{'bg-white text-black': activeTab === 'categories'}" class="w-full text-left p-2 rounded-full hover:bg-white hover:text-black">
        <i class="fas fa-heart mr-2"></i> Categories
      </button>
    </li>
    @endif
    <li class="mb-4">
      <button @click="activeTab = 'profile'" :class="{'bg-white text-black': activeTab === 'profile'}" class="w-full text-left p-2 rounded-full hover:bg-white hover:text-black">
        <i class="fas fa-user mr-2"></i> Profile
      </button>
    </li>
  </ul>
</div>
