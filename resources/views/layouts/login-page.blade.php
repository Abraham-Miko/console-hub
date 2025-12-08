<x-page-template>
    @section('title', 'Sign In')

    {{-- NAVBAR --}}

    <a href="{{ route("welcome") }}" class="absolute top-4 right-4 text-gray-500 hover:text-[#e29402] p-1 rounded-full
    transition duration-150" aria-label="Close">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </a>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <x-logo-and-title>sign in to your account</x-logo-and-title>
        <hr class="w-64 border-gray-300 my-4">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md
        overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

</x-page-template>
