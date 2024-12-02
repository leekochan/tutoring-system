<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-4 px-4">
                {{ __('Create Lessons') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 sm:py-16">
        <div class="mx-auto max-w-2xl p-6 lg:px-8 shadow-lg rounded-lg bg-white">
            <form method="POST" action="/lesson/create">
                @csrf

                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12" style="margin-bottom: 50px;">
                        <h2 class="text-base/7 font-semibold text-gray-900">Create new lesson.</h2>
                        <p class="mt-1 text-sm/6 text-gray-600">Please fill this information about your new lesson.</p>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" style="margin-bottom: 20px;">
                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="title" id="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6 rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" style="margin-bottom: 20px;">
                        <div class="sm:col-span-4">
                            <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="description" id="description" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6 rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" style="margin-bottom: 20px;">
                        <div class="sm:col-span-4">
                            <label for="price" class="block text-sm/6 font-medium text-gray-900">Price</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="price" id="price" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6 rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" style="margin-bottom: 20px;">
                        <div class="sm:col-span-4">
                            <label for="duration" class="block text-sm/6 font-medium text-gray-900">Duration</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="duration" id="duration" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6 rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" style="margin-bottom: 20px;">
                        <div class="sm:col-span-4">
                            <label for="topics" class="block text-sm/6 font-medium text-gray-900">Number of topics</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="topics" id="topics" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6 rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="/dashboard" class="text-sm/6 font-semibold text-gray-900" style="padding-right: 12px;">Cancel</a>
                    <button type="submit" class="rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" style="background-color: #0054ff;">Save</button>
                </div>
            </form>
        </div>
    </div>



</x-app-layout>
