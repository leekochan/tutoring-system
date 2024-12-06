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

                <div class="bg-white shadow-md rounded-lg p-10">
                    <h1 class="font-bold text-2xl mb-2 ml-4">Your upcoming tutoring session.</h1>
                    @if($schedules->isEmpty())
                        <h1 class="text-xl text-gray-600 ml-4 mt-4">No scheduled sessions yet..</h1>
                    @else
                        <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($schedules->sortBy(['booking_date', 'booking_time']) as $schedule)
                                <div class="block p-4 h-full">
                                    <div class="flex flex-col bg-orange-100 rounded-lg shadow-md cursor-pointer group-hover:shadow-xl transition-shadow p-6 h-full">
                                        <h1 class="text-2xl font-bold text-gray-900 mb-2 truncate" title="{{ $schedule->lesson->title }}" style="font-size: larger">
                                            {{ $schedule->lesson->title }}
                                        </h1>
                                        <p class="text-base text-gray-600 flex-grow mt-2">
                                            Tutor: <span class="font-semibold text-black">{{ $schedule->tutor->name }}</span>
                                        </p>
                                        <div class="flex flex-row justify-center">
                                            <p class="text-base text-gray-600 flex-grow mt-2">
                                                Date: <span class="font-semibold text-black">{{ $schedule->booking_date }}</span>
                                            </p>
                                            <p class="text-base text-gray-600 flex-grow mt-2">
                                                Time: <span class="font-semibold text-black">{{ $schedule->booking_time }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-6 text-right">
                        <button class="py-2 px-4 mr-4 bg-green-600 uppercase hover:bg-green-700 text-white rounded-md w-1/4">
                            <a href="/student/schedule">My Schedule >></a>
                        </button>
                    </div>
                </div>

                {{-- Recommended Tutors Section --}}
                <div class="bg-white shadow-md rounded-lg p-10">
                    <h2 class="font-bold text-2xl mb-2 ml-4">New topics available!!</h2>
                    <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($lessons as $lesson)
                            <div class="block p-4 h-full">
                                <div class="flex flex-col bg-blue-100 rounded-lg shadow-md cursor-pointer group-hover:shadow-xl transition-shadow p-6 h-full">
                                    <h1 class="text-2xl font-bold text-gray-900 mb-2 truncate" title="{{ $lesson->title }}" style="font-size: larger">
                                        {{ $lesson->title }}
                                    </h1>
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Tutor: <span class="font-semibold text-black">{{ $lesson->tutor->name }}</span>
                                    </p>
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Price: <span class="font-semibold text-black">₱{{ $lesson->price }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-right">
                        <button class="py-2 px-4 mr-4 bg-green-600 uppercase hover:bg-green-700 text-white rounded-md w-1/4">
                            <a href="/topics">Find more >></a>
                        </button>
                    </div>
                </div>
                    {{-- Other Features Section --}}
{{--                <div class="bg-white shadow-lg rounded-lg p-6">--}}
{{--                    <h2 class="font-bold text-lg mb-4">Other Features</h2>--}}
{{--                    <ul class="list-disc list-inside space-y-2">--}}
{{--                        <li><a href="#" class="text-blue-600 hover:underline">Academic Resources</a></li>--}}
{{--                        <li><a href="#" class="text-blue-600 hover:underline">Track Your Progress</a></li>--}}
{{--                        <li><a href="#" class="text-blue-600 hover:underline">Support Center</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

</x-layouts.student-app>
