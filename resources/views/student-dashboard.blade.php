<x-student.student-app>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Browse available lessons') }}
            </h2>
        </div>
    </x-slot>
    <!-- Main Content (Grid Layout) remains the same -->
    <div class="py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mt-12 grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($lessons as $lesson)
                    <div class="block p-4 h-full">
                        <div @click="openModal({
                                id: {{ $lesson->id }},
                                tutor: {{ $lesson->lesson_tutor }},
                                title: '{{ $lesson->title }}',
                                description: '{{ $lesson->description }}',
                                price: '{{ $lesson->price }}',
                                duration: '{{ $lesson->duration }}',
                                topics_count: '{{ $lesson->topics_count }}'
                            })"
                             class="flex flex-col bg-white rounded-lg shadow-md cursor-pointer group-hover:shadow-xl transition-shadow p-6 h-full">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2 truncate" title="{{ $lesson->title }}" style="font-size: larger">
                                {{ $lesson->title }}
                            </h3>
                            <p class="text-base text-gray-600 flex-grow">
                                Tutor: <span class="font-semibold text-black">{{ $lesson->tutor->name }}</span>
                            </p>
                            <p class="text-base text-gray-600 flex-grow">
                                Price: <span class="font-semibold text-black">{{ $lesson->price }}</span>
                            </p>
                            <a href="/lesson/{{ $lesson->id }}/book" class="inline-flex items-center justify-center px-4 py-2 mt-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer" style="width: auto">
                                Book Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-student.student-app>
