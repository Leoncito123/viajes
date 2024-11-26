<x-guest-layout>
    <div class="container mx-auto p-6">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Two-Factor Authentication') }}</h2>
                <form method="POST" action="{{ route('2fa.verify') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="2fa_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Authentication Code') }}</label>
                        <input id="2fa_code" type="text" name="2fa_code" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-300" required autofocus>
                        @error('2fa_code')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-400">
                            {{ __('Verify') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
