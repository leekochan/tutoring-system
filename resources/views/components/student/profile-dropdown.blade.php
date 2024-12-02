<div class="relative ml-3 group"> <!-- Add group class to the container -->
    <!-- Profile Button with Image -->
    <button onclick="toggleProfileMenu()" type="button" class="relative flex max-w-xs items-center rounded-full bg-green-600 text-sm focus:outline-none">
        <img class="h-8 w-8 rounded-full" src="https://www.1999.co.jp/itbig88/10883217.jpg" alt="">
    </button>

    <!-- Username Tooltip -->
    <span class="absolute left-0 w-full text-center bottom-[-20px] text-sm bg-green-100 text-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
    {{ auth()->check() ? auth()->user()->username : 'Guest' }}
    </span>

    <!-- Profile Menu Dropdown -->
    <div id="profileMenuDropdown" class="hidden absolute right-0 z-40 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
        <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">
            Profile
        </a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">
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
