@php
    use App\Models\CancelledSession;
    use App\Models\CompletedSession;
@endphp
<x-layouts.student-app>
    <div class="relative z-20 flex items-start justify-center min-h-screen w-full">
        {{-- Dashboard Content for Logged-In Users --}}
        <div class="w-full max-w-7xl p-6 space-y-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Upcoming Sessions Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Upcoming Sessions</h2>
                @if($schedules->isEmpty())
                    <h1 class="text-gray-600 ml-4 mt-4">No scheduled sessions yet..</h1>
                @else
                    <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($schedules->sortBy(['booking_date', 'booking_time']) as $schedule)
                            <div class="block p-4 h-full">
                                <div
                                    class="flex flex-col bg-gray-200 rounded-lg shadow-lg cursor-pointer group-hover:shadow-xl transition-shadow p-6 h-full">
                                    <!-- Session details remain the same -->
                                    <h1 class="text-2xl font-bold text-gray-900 mb-2 truncate"
                                        title="{{ $schedule->lesson->title }}" style="font-size: larger">
                                        {{ $schedule->lesson->title }}
                                    </h1>
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Tutor: <span
                                            class="font-semibold text-black">{{ $schedule->tutor->name }}</span>
                                    </p>
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Date: <span
                                            class="font-semibold text-black">{{ $schedule->booking_date }}</span>
                                    </p>
                                    <div class="mb-2 mt-2 border-t border-solid border-gray-300">
                                        <p class="text-base text-gray-600 flex-grow mt-2">
                                            Morning Session: <span
                                                class="font-semibold text-black">{{ $schedule->morning_session_hours }}</span>
                                        </p>
                                        <p class="text-base text-gray-600 flex-grow mt-2">
                                            Time: <span
                                                class="font-semibold text-black">{{ $schedule->morning_session_time ?? 'No session' }}</span>
                                        </p>
                                    </div>
                                    <div class="border-y border-solid border-gray-300 pb-2">
                                        <p class="text-base text-gray-600 flex-grow mt-2">
                                            Afternoon Session: <span class="font-semibold text-black">{{ $schedule->afternoon_session_hours }} hour/s</span>
                                        </p>
                                        <p class="text-base text-gray-600 flex-grow mt-2">
                                            Time: <span
                                                class="font-semibold text-black">{{ $schedule->afternoon_session_time ?? 'No session' }}</span>
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-center justify-center mt-2">
                                        <button
                                            onclick="openCancelModal({{ $schedule->id }})"
                                            class="inline-flex w-3/4 items-center justify-center px-4 py-2 mt-4 mr-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-400 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer">
                                            Cancel session
                                        </button>
{{--                                        <a href="#"--}}
{{--                                           onclick="event.preventDefault(); document.getElementById('mark-done-form-{{ $schedule->id }}').submit();"--}}
{{--                                           class="inline-flex items-center justify-center px-4 py-2 mt-4 mr-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer">--}}
{{--                                            Mark as done--}}
{{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                            <form id="mark-done-form-{{ $schedule->id }}"
                                  action="{{ route('session.mark-done', $schedule->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        @endforeach
                    </div>
                @endif
            </div>

            {{--Completed session--}}
            {{--            <div class="py-12 sm:py-16">--}}
            {{--                <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-gray-50 py-4 rounded-lg">--}}
            {{--                    <!-- Completed Sessions Section -->--}}
            {{--                    <div class="mb-8">--}}
            {{--                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Completed Sessions</h2>--}}
            {{--                        <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">--}}
            {{--                            <!-- Completed sessions will be added later -->--}}
            {{--                            <p class="text-gray-500">No completed sessions yet.</p>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <!-- Cancelled Sessions Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Cancelled Sessions</h2>
                @php
                    $cancelledSessions = CancelledSession::where('student_id', auth()->user()->username)->take(6)->latest()->get();
                @endphp
                @if($cancelledSessions->isEmpty())
                    <p class="text-gray-600 ml-4">No cancelled sessions.</p>
                @else
                    <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($cancelledSessions as $cancelledSession)
                            <div class="block p-4 h-full">
                                <div class="flex flex-col bg-red-50 rounded-lg shadow-lg p-6 h-full">
                                    <h1 class="text-xl font-bold text-red-900 mb-2 truncate">
                                        {{ $cancelledSession->lesson->title }}
                                    </h1>
                                    <p class="text-base text-red-600 flex-grow mt-2">
                                        Tutor: <span
                                            class="font-semibold text-red-600">{{ $cancelledSession->tutor->name }}</span>
                                    </p>
                                    <p class="text-base text-red-600">Cancelled
                                        on: {{ $cancelledSession->cancelled_at }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
{{--                    <div class="mt-6 text-right">--}}
{{--                        <button--}}
{{--                            class="py-2 px-4 mr-4 bg-green-600 uppercase hover:bg-green-700 text-white rounded-md w-1/4">--}}
{{--                            <a href="/cancelled-session">View all >> >></a>--}}
{{--                        </button>--}}
{{--                    </div>--}}
                @endif
            </div>



            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Completed Sessions</h2>

                @php
                    // Use the session variable if it exists, otherwise use an empty collection
                    $completedSessions = CompletedSession::with('schedule.lesson', 'schedule.tutor')
                        ->whereHas('schedule', function($query) {
                            $query->where('student_id', auth()->user()->username);
                        })
                        ->latest('completed_date')
                        ->take(6)
                        ->get();
                @endphp

                @if($completedSessions->isEmpty())
                    <p class="text-gray-600 ml-4">No completed sessions.</p>
                @else
                    <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($completedSessions as $completedSession)
                            <div class="block p-4 h-full">
                                <div class="flex flex-col bg-green-50 rounded-lg shadow-lg p-6 h-full">
                                    <h1 class="text-xl font-bold text-green-900 mb-2 truncate">
                                        {{ $completedSession->schedule->lesson->title }}
                                    </h1>
                                    <p class="text-base text-green-600 flex-grow mt-2">
                                        Tutor: <span class="font-semibold text-green-600">{{ $completedSession->schedule->tutor->name }}</span>
                                    </p>
                                    <p class="text-base text-green-600">
                                        Completed on: {{ $completedSession->completed_date }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Cancel Confirmation Modal -->
        <div id="cancelModal"
             class="fixed inset-0 z-50 hidden items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
            <div class="relative w-full max-w-md mx-auto">
                <div
                    class="relative flex flex-col w-full bg-gray-200 border-0 rounded-lg shadow-xl outline-none focus:outline-none">
                    <div class="relative p-4 flex-auto">
                        <p class="my-2 text-black text-lg leading-relaxed">
                            Do you want to cancel this session?
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-end px-4 py-3 border-t border-solid rounded-b border-gray-300">
                        <button
                            onclick="closeCancelModal()"
                            class="mr-4 text-sm font-bold text-gray-600 uppercase outline-none background-transparent focus:outline-none ease-linear transition-all duration-150">
                            No
                        </button>
                        <form id="cancelSessionForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 mr-1 text-sm font-bold text-white uppercase bg-red-500 rounded shadow hover:bg-red-600 outline-none focus:outline-none ease-linear transition-all duration-200">
                                Yes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openCancelModal(scheduleId) {
            const modal = document.getElementById('cancelModal');
            const form = document.getElementById('cancelSessionForm');
            form.action = `/session/${scheduleId}/cancel`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeCancelModal() {
            const modal = document.getElementById('cancelModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.querySelector('.bg-green-100');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.5s ease-out';
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        successMessage.remove();
                    }, 500);
                }, 3000);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.querySelector('.bg-green-100');
            const errorMessage = document.querySelector('.bg-red-100');

            // Handle success messages (existing code)
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.5s ease-out';
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        successMessage.remove();
                    }, 500);
                }, 3000);
            }

            // Handle error messages (new code)
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.transition = 'opacity 0.5s ease-out';
                    errorMessage.style.opacity = '0';
                    setTimeout(() => {
                        errorMessage.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>
</x-layouts.student-app>
