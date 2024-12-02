<x-layouts.student-app>

    <div x-data="{ sidebarOpen: false }" class="flex">
        <div class="relative z-20 flex items-center justify-center min-h-screen w-full">
                {{-- Dashboard Content for Logged-In Users --}}
            <div class="w-full max-w-7xl p-6 space-y-8">
                {{-- Welcome Section --}}
                <header>
                    <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
                    <p class="text-gray-600">Browse available topics you need.</p>
                </header>

                {{-- Recommended Tutors Section --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="font-bold text-lg mb-4">Recommended Tutors</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="font-bold">Stephen Jake Apostol</h3>
                            <p>Programming Expert</p>
                            <p class="text-gray-500">Available: 2-4 PM</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="font-bold">Ralph Vincent Rodriguez</h3>
                            <p>Software Engineering Expert</p>
                            <p class="text-gray-500">Available: 3-5 PM</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="font-bold">Archie Lacurom</h3>
                            <p>MagLu2 Expert</p>
                            <p class="text-gray-500">Available: 1-3 PM</p>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button class="py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded w-full">
                            <a href="/topics">Find More</a>
                        </button>
                    </div>
                </div>
                    {{-- Billing/Balance Section --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="font-bold text-lg mb-4">Billings/Balance</h2>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">₱1,200</p>
                        <p class="text-gray-500">Outstanding Balance</p>
                        <div class="mt-4">
                            <button class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
                    {{-- Other Features Section --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="font-bold text-lg mb-4">Other Features</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><a href="#" class="text-blue-600 hover:underline">Academic Resources</a></li>
                        <li><a href="#" class="text-blue-600 hover:underline">Track Your Progress</a></li>
                        <li><a href="#" class="text-blue-600 hover:underline">Support Center</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-layouts.student-app>
