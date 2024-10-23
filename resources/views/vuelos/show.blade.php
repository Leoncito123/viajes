<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-">
        <div class="max-w-8xl ">
            <div class="bg-white  dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 dark:text-gray-100">
                    <div>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="grid md:grid-cols-2 border border-indigo-500 rounded-lg p-6">

                            </div>
                            <div class="grid md:grid-cols-2 border border-indigo-500 rounded-lg p-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
