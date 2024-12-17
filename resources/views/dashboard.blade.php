<x-app-layout>
    <!-- Header slot remains the same -->
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('My available lessons') }}
            </h2>
            <a href="/lesson/create" class="inline-flex items-center py-2 px-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create Lessons
            </a>
        </div>
    </x-slot>
        <!-- Main Content (Grid Layout) remains the same -->
        <div class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class=" grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($lessons as $lesson)
                        <div class="block p-4 h-full">
                            <div @click="openModal({
                                id: {{ $lesson->id }},
                                title: '{{ $lesson->title }}',
                                description: '{{ $lesson->description }}',
                                price: '{{ $lesson->price }}',
                                duration: '{{ $lesson->duration }}',
                                topics_count: '{{ $lesson->topics_count }}'
                            })"
                                 class="flex flex-col bg-white rounded-lg shadow-lg cursor-pointer group-hover:shadow-xl transition-shadow py-4 px-6 h-full">
                                <h3 class="text-2xl font-bold text-gray-900 truncate" title="{{ $lesson->title }}" style="font-size: larger">
                                    {{ $lesson->title }}
                                </h3>
                                <div class="flex flex-row">
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Price: ₱<span class="font-semibold text-black">{{ $lesson->price }}</span>
                                    </p>
                                    <p class="text-base text-gray-600 flex-grow mt-2">
                                        Duration: <span class="font-semibold text-black">{{ $lesson->duration }} hour/s</span>
                                    </p>
                                </div>
                                <p class="text-base text-gray-600 flex-grow">
                                    Topic/s: <span class="font-semibold text-black">{{ $lesson->topics }}</span>
                                </p>
                                <a href="/lesson/{{ $lesson->id }}/edit" class="w-1/2 inline-flex items-center justify-center px-4 py-2 mt-4 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>
