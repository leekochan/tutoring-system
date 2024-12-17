<x-layouts.student-app>
    <div class="container mx-auto">
        {{-- Page Title --}}
        <div class="relative z-20 flex justify-center min-h-screen w-full">
            {{-- Dashboard Content for Logged-In Users --}}
            <div class="w-full max-w-7xl p-6 space-y-8">
                <div class="flex items-center mb-12 w-full">
                    <h1 class="text-2xl font-bold mr-6">Topics available</h1>
                    <form id="searchForm" action="{{ route('topics.ai-search') }}" method="GET" class="flex-grow ml-auto">
                        <input
                            type="text"
                            name="search"
                            id="searchInput"
                            placeholder="AI-powered lesson search..."
                            class="w-1/2 px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </form>
                </div>

                {{-- Tutors Grid --}}
                <div class="grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($lessons as $lesson)
                        <div data-lesson-card class="block p-4 h-full">
                            <div class="flex flex-col bg-white rounded-lg shadow-xl cursor-pointer group-hover:shadow-xl transition-shadow p-6 h-full">
                                <h1 data-lesson-title class="text-2xl font-bold text-gray-900 mb-2 truncate" title="{{ $lesson->title }}" style="font-size: larger">
                                    {{ $lesson->title }}
                                </h1>
                                <p class="text-base text-gray-600 flex-grow mt-2">
                                    Tutor: <span class="font-semibold text-black">{{ $lesson->tutor->name }}</span>
                                </p>
                                <div class="flex flex-row items-center mt-2">
                                    <button class="inline-flex items-center justify-center px-4 py-2 mt-4 mr-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer"
                                            onclick="openModal({{ $lesson->id }})">
                                        View lesson
                                    </button>
                                    <a href="/lesson/{{$lesson->id}}/book" class="inline-flex items-center justify-center px-4 py-2 mt-4 mr-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-400 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hover:cursor-pointer">
                                        Book lesson
                                    </a>
                                </div>
                            </div>
                        </div>
{{--                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">--}}
{{--                            --}}{{-- Tutor Name & Position --}}
{{--                            <h2 class="text-xl font-semibold text-center">{{ $lesson->title }}</h2>--}}
{{--                            <p class="text-gray-600 text-center">Tutor: {{ $lesson->tutor->name }}</p>--}}

{{--                            --}}{{-- Action Buttons --}}
{{--                            <div class="mt-4 flex justify-center space-x-4">--}}
{{--                                <button class="bg-white text-black py-2 px-4 border rounded-md hover:bg-gray-200"--}}
{{--                                        onclick="openModal({{ $lesson->id }})">--}}
{{--                                    View--}}
{{--                                </button>--}}
{{--                                <button class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">--}}
{{--                                    <a href="/lesson/{{$lesson->id}}/book">Book Now</a>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        {{-- Modal --}}
                        <div id="modal-{{ $lesson->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-30">
                            <div class="bg-white rounded-lg shadow-lg w-1/2 max-w-1/2 mx-auto mt-32 mb-32 p-10 h-auto relative">
                                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800"
                                        onclick="closeModal({{ $lesson->id }})">
                                    &times;
                                </button>
                                <div class="flex flex-col justify-between">
                                    <div class="flex items-center rounded mb-2" title="{{ $lesson->title }}" style="font-size: larger">
                                        <h1 class="text-4xl font-bold">{{ $lesson->title }}</h1>
                                    </div>
                                    <div class="flex items-center rounded mb-6">
                                        <p class="text-xl font-bold text-gray-600">Tutor: <span class="font-normal">{{ $lesson->tutor->name }}</span></p>
                                    </div>
                                    <div class="flex items-center rounded mb-6">
                                        <p class="text-xl font-bold text-gray-600">Description: <span class="font-normal">{{ $lesson->description }}</span></p>
                                    </div>
                                    <div class="flex flex-row mb-6">
                                        <div class="flex items-center rounded w-auto mr-8">
                                            <p class="text-xl font-bold text-gray-600">Price: <span class="font-normal">₱{{ $lesson->price }}</span></p>
                                        </div>
                                        <div class="flex items-center rounded w-auto mr-8">
                                            <p class="text-xl font-bold text-gray-600">Duration: <span class="font-normal">{{ $lesson->duration }} hour/s</span></p>
                                        </div>
                                        <div class="flex items-center rounded w-auto mr-8">
                                            <p class="text-xl font-bold text-gray-600">No.topic: <span class="font-normal">{{ $lesson->topics }}</span></p>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="mt-6 flex flex-row justify-between">
                                    <button class="bg-green-500 mr-2 text-white py-2 px-4 uppercase rounded-md hover:bg-green-600">
                                        <a href="/lesson/{{$lesson->id}}/book">Book Now</a>
                                    </button>
                                    <button class="bg-white text-black font-semibold py-2 px-4 border rounded-md uppercase hover:bg-gray-200"
                                            onclick="closeModal({{ $lesson->id }})">
                                        close
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Restore background scrolling
        }

        // document.addEventListener('DOMContentLoaded', function() {
        //     const searchInput = document.getElementById('searchInput');
        //     const lessonCards = document.querySelectorAll('[data-lesson-card]');
        //
        //     searchInput.addEventListener('input', function() {
        //         const searchTerm = this.value.toLowerCase().trim();
        //
        //         lessonCards.forEach(card => {
        //             const title = card.querySelector('[data-lesson-title]').textContent.toLowerCase();
        //
        //             if (searchTerm === '' || title.includes(searchTerm)) {
        //                 card.style.display = 'block';
        //             } else {
        //                 card.style.display = 'none';
        //             }
        //         });
        //     });
        // });
    </script>
</x-layouts.student-app>
