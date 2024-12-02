<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-4 px-4">
                {{ __('Create Lessons') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 sm:py-16 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
            <form method="POST" action="/lesson/create">
                @csrf
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b bg-gray-50">
                    <h2 class="text-black font-semibold text-xl">Create lesson</h2>
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
                                       class="mt-2 w-full rounded-md border-0 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </label>
                            <label class="block" style="margin-top: 15px">
                                <span class="text-lg font-medium text-gray-700">Description</span>
                                <input type="text"
                                       name="description"
                                       id="description"
                                       class="mt-2 w-full rounded-md border-0 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-8" style="margin-top: 15px">
                            <label class="block">
                                <span class="text-lg font-medium text-gray-700">Price</span>
                                <div class="mt-2 relative flex items-center-center">
                                    <input type="text"
                                           name="price"
                                           id="price"
                                           class="w-full rounded-md border-0 pl-8 shadow-sm focus:border-blue-500 focus:ring-blue-500" style="margin-right: 10px;">
                                </div>
                            </label>
                            <label class="block">
                                <span class="text-lg font-medium text-gray-700">Duration(hours)</span>
                                <div class="mt-2 relative">
                                    <input type="text"
                                           name="duration"
                                           id="duration"
                                           class="w-full rounded-md border-0 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </label>
                        </div>
                        <label class="block" style="margin-top: 15px">
                            <span class="text-lg font-medium text-gray-700">Number of Topics</span>
                            <input type="text"
                                   name="topics"
                                   id="topics"
                                   class="mt-2 w-full rounded-md border-0 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </label>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="/dashboard" class="text-sm/6 font-semibold text-gray-900" style="padding-right: 12px;">Cancel</a>
                        <button type="submit" class="rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" style="background-color: #0054ff;">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
