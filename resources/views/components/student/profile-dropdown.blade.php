<div class="relative ml-3 group"> <!-- Add group class to the container -->
    <!-- Profile Button with Image -->
    <button onclick="toggleProfileMenu()" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-xl leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
        <div>{{ Auth::user()->name }}</div>

        <div class="ms-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    </button>

    <!-- Username Tooltip -->
{{--    <span class="absolute left-0 w-full text-center bottom-[-20px] text-sm bg-green-100 text-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">--}}
{{--    {{ auth()->check() ? auth()->user()->username : 'Guest' }}--}}
{{--    </span>--}}

    <!-- Profile Menu Dropdown -->
    <div id="profileMenuDropdown" class="hidden absolute right-0 z-40 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
        <a href="/profile" class="block px-4 py-2 text-lg text-gray-700 hover:bg-green-600 hover:text-white">
            Profile
        </a>
        <a href="#" class="block px-4 py-2 text-lg text-gray-700 hover:bg-green-600 hover:text-white">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-lg text-gray-700 hover:bg-green-600 hover:text-white">
                Logout
            </button>
        </form>
    </div>
</div>

<script>
    // Function to toggle profile menu visibility
    function toggleProfileMenu() {
        const menu = document.getElementById('profileMenuDropdown');
        menu.classList.toggle('hidden'); // Toggle visibility of profile dropdown menu
    }
</script>
