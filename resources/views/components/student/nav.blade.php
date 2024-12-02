<nav class="bg-white fixed w-full z-40 border-b">
    <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Left section -->
            <div class="flex items-center">
                <button
                        type="button"
                        onclick="toggleSidebar()"
                        class="p-2 text-green-600 hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                @include('components.student.logo')
            </div>


            <div class="flex items-center">

                @include('components.student.header-right')
            </div>
        </div>
    </div>
</nav>
