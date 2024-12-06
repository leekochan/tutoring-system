<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>

    <div class="py-12 sm:py-16 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b rounded-t-lg">
                <h2 class="text-black font-semibold text-xl">Edit lesson</h2>
                <a href="/dashboard" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>

            <!-- Modal Body -->
            <div class="p-10" style="padding: 20px;">
                <div class="space-y-8">
                    <div class="space-y-4" style="margin-top: 10px">
                        <label class="block">
                            <span class="text-lg font-medium text-gray-700">Title</span>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   form="update"
                                   value="{{ $lesson->title }}"
                                   class="mt-2 w-full rounded-md border shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </label>

                        <label class="block" style="margin-top: 15px">
                            <span class="text-lg font-medium text-gray-700">Description</span>
                            <input type="text"
                                   name="description"
                                   id="description"
                                   form="update"
                                   value="{{ $lesson->description }}"
                                   class="mt-2 w-full rounded-md border shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </label>
                    </div>

                    <div class="flex flex-row items-center justify-center gap-4" style="margin-top: 15px">
                        <label class="block">
                            <span class="text-lg font-medium text-gray-700">Price</span>
                            <div class="mt-2 relative">
                                <input type="text"
                                       name="price"
                                       id="price"
                                       form="update"
                                       value="{{ $lesson->price }}"
                                       class="w-full rounded-md border shadow-sm focus:border-blue-500 focus:ring-blue-500" style="margin-right: 10px;">
                            </div>
                        </label>

                        <label class="block">
                            <span class="text-lg font-medium text-gray-700">Duration(hours)</span>
                            <div class="mt-2 relative">
                                <input type="text"
                                       name="duration"
                                       id="duration"
                                       form="update"
                                       value="{{ $lesson->duration }}"
                                       class="w-full rounded-md border shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </label>

                        <label class="block">
                            <span class="text-lg font-medium text-gray-700">Number of Topics</span>
                            <div class="mt-2 relative">
                                <input type="text"
                                       name="topics"
                                       id="topics"
                                       form="update"
                                       value="{{ $lesson->topics }}"
                                       class="w-full rounded-md border shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-between gap-2 p-6 border-t rounded-b-lg">
                <div class="flex items-center">
                    <button form="update" class="inline-flex items-center px-4 py-2 uppercase bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: #0054ff; margin-right: 10px;">
                        Update
                    </button>
                    <button form="delete" class="inline-flex items-center px-4 py-2 uppercase bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: red; margin-right: 10px;">
                        Delete
                    </button>
                </div>
                <a href="/dashboard"
                   class="inline-flex items-center border-2 px-4 py-2 text-gray-700 uppercase text-sm font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Close
                </a>
            </div>
        </div>
    </div>

    <form action="/lesson/{{ $lesson->id }}" method="POST" id="delete" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    <form action="/lesson/{{ $lesson->id }}" method="POST" id="update" class="hidden">
        @csrf
        @method('PATCH')
    </form>

</x-app-layout>
