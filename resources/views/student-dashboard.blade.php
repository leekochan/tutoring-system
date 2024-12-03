<x-layouts.student-app>

    <div x-data="{ sidebarOpen: false }" class="flex">
        <div class="relative z-20 flex items-start justify-center min-h-screen w-full">
                {{-- Dashboard Content for Logged-In Users --}}
            <div class="w-full max-w-7xl p-6 space-y-8">
                {{-- Welcome Section --}}
                <header class="mt-2">
                    <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
                    <p class="text-gray-600">Here's an overview of your tutoring activities.</p>
                </header>

                {{-- Recommended Tutors Section --}}
                <div class="bg-white shadow rounded-lg p-10">
                    <h2 class="font-bold text-2xl mb-4">New topics available!!</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($lessons as $lesson)
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <h3 class="text-lg font-bold pb-2">{{ $lesson->title }}</h3>
                                <p>Tutor: <span class="font-semibold pb-2">{{ $lesson->tutor->name }}</span></p>
                                <p>Price: <span class="font-semibold">{{ $lesson->price }}</span></p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <button class="py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded w-1/8">
                            <a href="/topics">Find more topics here!</a>
                        </button>
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
