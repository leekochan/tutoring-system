<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Your Schedules') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-4 rounded-lg">
            @if(session('error'))
                <div class="flash-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="text-2xl font-bold text-gray-900">Upcoming Sessions</h2>
            @if($schedules->isEmpty())
                <h1 class="text-gray-600 ml-4 mt-4">No scheduled sessions yet..</h1>
            @else
            <div class="mt-4 grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($schedules->sortBy(['booking_date', 'booking_time']) as $schedule)
                    <div class="block p-2 h-full">
                        <form action="{{ route('mark.session.done', $schedule->id) }}" method="POST">
                            @csrf
                            <div class="flex flex-col bg-blue-50 rounded-lg shadow-2xl cursor-pointer group-hover:shadow-xl transition-shadow p-4 h-full">
                                <h1 class="text-2xl font-bold text-gray-900 mb-2 truncate" title="{{ $schedule->lesson->title }}" style="font-size: larger">
                                    {{ $schedule->lesson->title }}
                                </h1>
                                <p class="text-base text-gray-900 flex-grow mt-2">
                                    Student: <span class="font-semibold text-black">{{ $schedule->student->name }}</span>
                                </p>
                                <p class="text-base text-gray-900 flex-grow mr-4 mt-2">
                                    Date: <span class="font-semibold text-black">{{ $schedule->booking_date }}</span>
                                </p>
                                <div class="mb-2 mt-2 border-t border-solid border-gray-300">
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Morning Session: <span
                                            class="font-semibold text-black">{{ $schedule->morning_session_hours }} hour/s</span>
                                    </p>
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Time: <span
                                            class="font-semibold text-black">{{ $schedule->morning_session_time ?? 'No session' }}</span>
                                    </p>
                                </div>
                                <div class="pb-2 border-y border-solid border-gray-300">
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Afternoon Session: <span class="font-semibold text-black">{{ $schedule->afternoon_session_hours }} hour/s</span>
                                    </p>
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Time: <span
                                            class="font-semibold text-black">{{ $schedule->afternoon_session_time ?? 'No session' }}</span>
                                    </p>
                                </div>
                                @if($schedule->completedSession()->doesntExist())
                                    <form action="{{ route('mark.session.done', $schedule->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center justify-center px-4 py-2 mt-4 mr-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer"
                                                onclick="return confirmMarkDone('{{ $schedule->booking_date }}')"
                                        >
                                            Mark as done
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        {{--Completed session--}}
        <div class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 py-4 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Completed Sessions</h2>
                @if($completedSessions->isEmpty())
                    <p class="text-gray-500 ml-4">No completed sessions yet.</p>
                @else
                    <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($completedSessions as $completedSession)
                            <div class="block p-2 h-full">
                                <div class="flex flex-col bg-green-50 rounded-lg shadow-md p-4 h-full">
                                    <h1 class="text-2xl font-bold text-gray-900 mb-2 truncate" style="font-size: larger">
                                        {{ $completedSession->schedule->lesson->title }}
                                    </h1>
                                    <p class="text-base text-gray-900 flex-grow mt-2">
                                        Student: <span class="font-semibold text-black">{{ $completedSession->schedule->student->name }}</span>
                                    </p>
                                    <p class="text-base text-gray-900 flex-grow mr-4 mt-2">
                                        Session Date: <span class="font-semibold text-black">{{ $completedSession->schedule->booking_date }}</span>
                                    </p>
                                    <p class="text-base text-gray-900 flex-grow mr-4 mt-2">
                                        Completed On: <span class="font-semibold text-black">{{ $completedSession->completed_date }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmMarkDone(bookingDate) {
                const sessionDate = new Date(bookingDate);
                const currentDate = new Date();

                // Ensure the current date is strictly after the session date
                if (currentDate <= sessionDate) {
                    alert('You can only mark this session as done after its scheduled date.');
                    return false;
                }
                return confirm('Are you sure you want to mark this session as completed?');
            }

            document.addEventListener('DOMContentLoaded', function() {
                const flashMessages = document.querySelectorAll('.flash-message');

                flashMessages.forEach(function(message) {
                    setTimeout(function() {
                        message.style.transition = 'opacity 0.5s ease';
                        message.style.opacity = '0';

                        // Remove the element from the DOM after fade out
                        setTimeout(function() {
                            message.remove();
                        }, 500);
                    }, 3000);
                });
            });
        </script>
    @endpush

</x-app-layout>
