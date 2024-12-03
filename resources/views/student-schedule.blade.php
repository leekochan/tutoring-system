<x-layouts.student-app>

    @foreach($schedules as $schedule)
    <div class="relative z-20 flex items-start justify-center min-h-screen w-full">
        {{-- Dashboard Content for Logged-In Users --}}
        <div class="w-full max-w-7xl p-6 space-y-8">
            {{ $schedule->booking_date }}
        </div>
    </div>
    @endforeach


</x-layouts.student-app>
