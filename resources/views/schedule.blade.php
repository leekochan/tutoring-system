<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Your Schedules') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-gray-50 py-4 rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900">Upcoming Sessions</h2>
            @if($schedules->isEmpty())
                <h1 class="text-gray-600 ml-4 mt-4">No scheduled sessions yet..</h1>
            @else
            <div class="mt-4 grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($schedules->sortBy(['booking_date', 'booking_time']) as $schedule)
                    <div class="block p-2 h-full">
                        <div class="flex flex-col bg-blue-50 rounded-lg shadow-md cursor-pointer group-hover:shadow-xl transition-shadow p-4 h-full">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2 truncate" title="{{ $schedule->lesson->title }}" style="font-size: larger">
                                {{ $schedule->lesson->title }}
                            </h1>
                            <p class="text-base text-gray-900 flex-grow mt-2">
                                Student: <span class="font-semibold text-black">{{ $schedule->student->name }}</span>
                            </p>
                            <div class="flex flex-row items-center">
                                <p class="text-base text-gray-900 flex-grow mr-4 mt-2">
                                    Date: <span class="font-semibold text-black">{{ $schedule->booking_date }}</span>
                                </p>
                                <p class="text-base text-gray-900 flex-grow mt-2">
                                    Time: <span class="font-semibold text-black">{{ $schedule->booking_time }}</span>
                                </p>
                            </div>
                            <div>
                                <a href="/session-done" class="inline-flex items-center justify-center px-4 py-2 mt-4 mr-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer">
                                    Mark as done
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

{{--        <div class="py-12 sm:py-16">--}}
{{--            <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-gray-100 py-4 rounded-lg">--}}
{{--            <!-- Pending Sessions Section -->--}}
{{--                <div class="mb-8">--}}
{{--                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Pending Sessions</h2>--}}
{{--                    <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">--}}
{{--                        <!-- Pending sessions will be added later -->--}}
{{--                        <p class="text-gray-500">No pending sessions at the moment.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-gray-50 py-4 rounded-lg">
            <!-- Completed Sessions Section -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Completed Sessions</h2>
                    <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Completed sessions will be added later -->
                        <p class="text-gray-500">No completed sessions yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
