<x-page-template>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <x-logo-and-title>sign in to your account</x-logo-and-title>
        <hr class="w-64 border-gray-300 my-4">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md
        overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

</x-page-template>
