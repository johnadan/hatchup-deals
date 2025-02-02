<!DOCTYPE html>
{{-- <html lang="en" x-data="app"> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <title>Deals App</title> --}}
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://kit.fontawesome.com/e784aa8757.js" crossorigin="anonymous"></script>
  {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/full.css" rel="stylesheet"> --}}
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> --}}
  {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
  {{-- <link href="./style.css" rel="stylesheet"> --}}
  <style>
    /* Sidebar styles */
    .sidebar {
        height: 100vh;
        overflow-y: auto;
    }

    /* Avatar styles */
    .avatar {
        width: 4rem;
        height: 4rem;
        border: 2px solid white;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .avatar {
        width: 3rem;
        height: 3rem;
        }
        .sidebar {
        height: auto;
        }
    }
  </style>
</head>
<body class="bg-white text-black">
  <!-- Sidebar for Desktop -->
  <div x-data="sidebarData" x-init="initSidebar()">
    <div x-html="sidebarTemplate"></div>
  </div>

  <!-- Navbar for Mobile -->
  <div x-data="navbarData" x-init="initNavbar()">
    <div x-html="navbarTemplate"></div>
  </div>

  <!-- Main Content -->
  <div class="md:ml-64 p-4">
    <!-- Businesses Tab Content -->
    <div x-show="activeTab === 'businesses'" class="tab-content">
      <h2 class="text-2xl font-bold mb-4">Featured Businesses</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <template x-for="business in businesses" :key="business.id">
          <div x-data="businessCardData" x-init="initBusinessCard(business)">
            <div x-html="businessCardTemplate"></div>
          </template>
        </template>
      </div>
      <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Categories</h2>
        <div class="grid grid-cols-2 gap-2">
          <template x-for="category in categories" :key="category">
            <button @click="loadCategory(category)" class="btn bg-orange-500 text-white rounded-lg text-left p-2 flex items-center">
              <i :class="categoryIcons[category]" class="mr-2"></i>
              <span class="text-sm md:text-base" x-text="category"></span>
            </button>
          </template>
        </div>
        <div class="mt-4">
          <template x-for="business in filteredBusinesses" :key="business.id">
            <div x-data="businessCardData" x-init="initBusinessCard(business)">
              <div x-html="businessCardTemplate"></div>
            </template>
          </template>
        </div>
      </div>
    </div>

    <!-- Deals Tab Content -->
    <div x-show="activeTab === 'deals'" class="tab-content">
      <h2 class="text-2xl font-bold mb-4">Featured Deals</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <template x-for="deal in deals" :key="deal.id">
          <div x-data="dealCardData" x-init="initDealCard(deal)">
            <div x-html="dealCardTemplate"></div>
          </template>
        </template>
      </div>
      <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Categories</h2>
        <div class="grid grid-cols-2 gap-2">
          <template x-for="category in categories" :key="category">
            <button @click="loadDealsCategory(category)" class="btn bg-orange-500 text-white rounded-lg text-left p-2 flex items-center">
              <i :class="categoryIcons[category]" class="mr-2"></i>
              <span class="text-sm md:text-base" x-text="category"></span>
            </button>
          </template>
        </div>
        <div class="mt-4">
          <template x-for="deal in filteredDeals" :key="deal.id">
            <div x-data="dealCardData" x-init="initDealCard(deal)">
              <div x-html="dealCardTemplate"></div>
            </template>
          </template>
        </div>
      </div>
    </div>

    <!-- Favorites Tab Content -->
    <div x-show="activeTab === 'favorites'" class="tab-content">
      <h2 class="text-2xl font-bold mb-4">Favorites</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <template x-for="business in favorites" :key="business.id">
          <div x-data="businessCardData" x-init="initBusinessCard(business)">
            <div x-html="businessCardTemplate"></div>
          </template>
        </template>
      </div>
    </div>

    <!-- Profile Tab Content -->
    <div x-show="activeTab === 'profile'" class="tab-content">
      <h2 class="text-2xl font-bold mb-4">Profile</h2>
      <div class="mb-8">
        <h3 class="text-xl font-bold mb-2">User  Information</h3>
        <div class="bg-gray-100 p-4 rounded-lg">
          <p><strong>Name:</strong> John Doe</p>
          <p><strong>Email:</strong> john.doe@example.com</p>
          <p><strong>Phone:</strong> +1 234 567 890</p>
          <p><strong>Address:</strong> 123 Main St, City, Country</p>
        </div>
      </div>
      <div>
        <h3 class="text-xl font-bold mb-2">Claimed Deals</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <template x-for="deal in claimedDeals" :key="deal.id">
            <div x-data="dealCardData" x-init="initDealCard(deal)">
              <div x-html="dealCardTemplate"></div>
            </template>
          </template>
        </div>
      </div>
    </div>
  </div>

  <!-- Include JS -->
  {{-- <script src="./main.js"></script> --}}
  <script>
    // main.js
    function app() {
        return {
        activeTab: 'businesses',
        businesses: [
            { id: 1, name: 'Business 1', description: 'This is business 1' },
            { id: 2, name: 'Business 2', description: 'This is business 2' },
        ],
        deals: [
            { id: 1, title: 'Deal 1', description: 'This is deal 1' },
            { id: 2, title: 'Deal 2', description: 'This is deal 2' },
        ],
        favorites: [
            { id: 1, name: 'Business 1', description: 'This is business 1' },
            { id: 2, name: 'Business 2', description: 'This is business 2' },
        ],
        claimedDeals: [
            { id: 1, title: 'Deal 1', description: 'This is deal 1' },
            { id: 2, title: 'Deal 2', description: 'This is deal 2' },
        ],
        categories: ['Category 1', 'Category 2'],
        categoryIcons: {
            'Category 1': 'fas fa-category-1',
            'Category 2': 'fas fa-category-2',
        },
        loadCategory(category) {
            console.log(`Loading category: ${category}`);
        },
        loadDealsCategory(category) {
            console.log(`Loading deals category: ${category}`);
        },
        };
    }

    function sidebarData() {
        return {
        sidebarTemplate: '',
        initSidebar() {
            this.sidebarTemplate = `
            <div class="sidebar">
                <h2>Sidebar</h2>
                <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                </ul>
            </div>
            `;
        },
        };
    }

    function navbarData() {
        return {
        navbarTemplate: '',
        initNavbar() {
            this.navbarTemplate = `
            <div class="navbar">
                <h2>Navbar</h2>
                <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                </ul>
            </div>
            `;
        },
        };
    }

    function businessCardData() {
        return {
        businessCardTemplate: '',
        initBusinessCard(business) {
            this.businessCardTemplate = `
            <div class="business-card">
                <h2>${business.name}</h2>
                <p>${business.description}</p>
            </div>
            `;
        },
        };
    }

    function dealCardData() {
        return {
        dealCardTemplate: '',
        initDealCard(deal) {
            this.dealCardTemplate = `
            <div class="deal-card">
                <h2>${deal.title}</h2>
                <p>${deal.description}</p>
            </div>
            `;
        },
        };
    }

    function modalData() {
        return {
        modalTemplate: '',
        initModal() {
            this.modalTemplate = `
            <div class="modal">
                <h2>Modal</h2>
                <p>This is a modal.</p>
            </div>
            `;
        },
        };
    }

    function dealProfileData() {
        return {
        dealProfileTemplate: '',
        initDealProfile(deal) {
            this.dealProfileTemplate = `
            <div class="deal-profile">
                <h2>${deal.title}</h2>
                <p>${deal.description}</p>
            </div>
            `;
        },
        };
    }

    function businessProfileData() {
        return {
        businessProfileTemplate: '',
        initBusinessProfile(business) {
            this.businessProfileTemplate = `
            <div class="business-profile">
                <h2>${business.name}</h2>
                <p>${business.description}</p>
            </div>
            `;
        },
        };
    }
  </script>
</body>
</html>
