<x-layouts.student-app>
    <div class="relative z-20 flex items-start justify-center min-h-screen w-full">
        {{-- Dashboard Content for Logged-In Users --}}
        <div class="w-full max-w-7xl p-6 space-y-8">
            <!-- Upcoming Sessions Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Upcoming Sessions</h2>
                <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($schedules->sortBy(['booking_date', 'booking_time']) as $schedule)
                        <div class="block p-4 h-full">
                            <div class="flex flex-col bg-gray-100 rounded-lg shadow-lg cursor-pointer group-hover:shadow-xl transition-shadow p-6 h-full">
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
                                <div class="flex flex-row items-center mt-2">
                                    <a href="/session-cancel" class="inline-flex items-center justify-center px-4 py-2 mt-4 mr-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer">
                                        Cancel session
                                    </a>
                                    <a href="/session-done" class="inline-flex items-center justify-center px-4 py-2 mt-4 mr-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer">
                                        Mark as done
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pending Sessions Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pending Sessions</h2>
                <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Pending sessions will be added later -->
                    <p class="text-gray-500">No pending sessions at the moment.</p>
                </div>
            </div>

            <!-- Completed Sessions Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Completed Sessions</h2>
                <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Completed sessions will be added later -->
                    <p class="text-gray-500">No completed sessions yet.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.student-app>
