<!-- resources/views/layouts/partials/header.blade.php -->
<!-- Top Header -->
<header class="dashboard-header sticky top-0 z-10 py-4 px-6 flex items-center justify-between shadow-sm">
    <div class="flex items-center">
        <button class="text-gray-500 hover:text-gray-700 mr-4 md:hidden">
            <i class="fas fa-bars"></i>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}</h2>
        <span class="ml-2 text-sm bg-blue-100 text-blue-600 py-0.5 px-2 rounded-full">Admin</span>
    </div>
    <div class="flex items-center space-x-5">
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-700 transition">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 rounded-full w-5 h-5 text-xs flex items-center justify-center text-white">3</span>
            </button>
        </div>
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-700 transition">
                <i class="fas fa-envelope text-lg"></i>
                <span class="absolute -top-1 -right-1 bg-blue-500 rounded-full w-5 h-5 text-xs flex items-center justify-center text-white">7</span>
            </button>
        </div>
        <div class="flex items-center">
            <div class="mr-3 text-right hidden md:block">
                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
            <div class="relative group">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=ffffff" alt="Profile" class="h-10 w-10 rounded-full border-2 border-blue-400 cursor-pointer">
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>