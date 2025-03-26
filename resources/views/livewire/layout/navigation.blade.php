<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-500 to-blue-800 shadow-md text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo & Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                <button @click="open = !open" class="sm:hidden p-2 focus:outline-none">
                    <i class="fas fa-bars text-white text-xl"></i>
                </button>

 <!-- Navigation Links (Desktop) -->
 <div class="hidden sm:flex items-center space-x-12">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="pl-4 hover:text-gray-300">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('entries.create')" :active="request()->routeIs('entries.create')" class="pl-4 hover:text-gray-300">
                    {{ __('Create Entry') }}
                </x-nav-link>
                <x-nav-link :href="route('entries.index')" :active="request()->routeIs('entries.index')" class="pl-4 hover:text-gray-300">
                    {{ __('List') }}
                </x-nav-link>
            </div>
        </div>

            <!-- Search Bar (Desktop) -->
            <form method="GET" action="{{ route('entries.index') }}" class="hidden sm:flex items-center space-x-2 w-full max-w-md">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="border border-gray-300 rounded px-3 py-2 w-48 sm:w-full text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                <i id="search-icon" class="fas fa-search text-white text-lg cursor-pointer hover:text-gray-300 transition-all duration-300 transform hover:scale-105 active:scale-95"></i>
            </form>

            <!-- User Dropdown -->
            <div class="hidden sm:flex items-center space-x-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md hover:text-gray-300 focus:outline-none transition">
                            <div>{{ auth()->user()->name }}</div>
                            <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Dropdown -->
    <div x-show="open" x-transition class="sm:hidden bg-blue-700 border-t border-gray-300">
        <div class="py-2 px-4 space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block text-white hover:text-gray-300">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('entries.create')" :active="request()->routeIs('entries.create')" class="block text-white hover:text-gray-300">
                {{ __('Create Entry') }}
            </x-nav-link>
            <x-nav-link :href="route('entries.index')" :active="request()->routeIs('entries.index')" class="block text-white hover:text-gray-300">
                {{ __('List') }}
            </x-nav-link>

            <!-- Search Bar (Mobile) -->
            <form method="GET" action="{{ route('entries.index') }}" class="mt-4 flex items-center space-x-2">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="border border-gray-300 rounded px-3 py-2 w-full text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                <i id="search-icon-mobile" class="fas fa-search text-white text-lg cursor-pointer hover:text-gray-300 transition-all duration-300 transform hover:scale-105 active:scale-95"></i>
            </form>

            <!-- User Dropdown (Mobile) -->
            <div class="mt-4 border-t border-gray-300 pt-2 text-white">
                <p>{{ auth()->user()->name }}</p>
                <x-dropdown-link :href="route('profile')" class="block hover:text-gray-300">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-start hover:text-gray-300">
                        <x-dropdown-link>
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function addSearchAnimation(iconId) {
            let icon = document.getElementById(iconId);
            if (icon) {
                icon.addEventListener('click', function () {
                    // Maghanap gamit ang input value
                    let input = icon.previousElementSibling;
                    if (input && input.value.trim() !== '') {
                        window.location.href = "{{ route('entries.index') }}?search=" + encodeURIComponent(input.value);
                    }

                    // Animation effect
                    icon.classList.add('animate-spin');
                    setTimeout(() => icon.classList.remove('animate-spin'), 1000);
                });
            }
        }

        addSearchAnimation('search-icon');
        addSearchAnimation('search-icon-mobile');
    });
</script>
