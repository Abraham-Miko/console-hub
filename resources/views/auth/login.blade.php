<x-login-page-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />

            <x-text-input id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email" :value="old('email')"
                            placeholder="example@example.com"
                            required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" />

                @if (Route::has('password.request'))
                    <a class="flex underline text-sm text-gray-600 hover:text-[#ff3c3c] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                    <!-- Tombol mata untuk Password -->
                    <button type="button"
                            id="togglePassword"
                            data-target="password"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <!-- Ikon mata tertutup -->
                        <img id="eyeClosed-password"
                                src="https://www.svgrepo.com/show/521651/eye-off.svg"
                                alt="Hide password"
                                class="w-5 h-5 opacity-40">

                        <!-- Ikon mata terbuka -->
                        <img id="eyeOpen-password"
                                src="https://www.svgrepo.com/show/448763/eye-on.svg"
                                alt="Show password"
                                class="w-5 h-5 hidden">
                    </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />


        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">

                <input id="remember_me"
                        type="checkbox"
                        class="rounded border-black text-[#ff0000] shadow-sm focus:ring-red-500"
                        name="remember">
                <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>

            </label>
        </div>

        <!-- Script toggle (MODIFIKASI UNTUK MENGELOLA KEDUA FIELD) -->
        <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Fungsi umum untuk mengelola toggle
            const setupPasswordToggle = (inputId, toggleId) => {
                const passwordInput = document.getElementById(inputId);
                const toggleButton = document.getElementById(toggleId);

                // Pengecekan keamanan: hanya jalankan jika elemen ditemukan
                if (!passwordInput || !toggleButton) {
                    return;
                }

                // Ambil ikon berdasarkan ID yang diubah
                const eyeOpen = document.getElementById('eyeOpen-' + inputId);
                const eyeClosed = document.getElementById('eyeClosed-' + inputId);


                toggleButton.addEventListener('click', () => {
                    const isHidden = passwordInput.type === 'password';
                    passwordInput.type = isHidden ? 'text' : 'password';

                    // Ganti ikon sesuai status
                    eyeOpen.classList.toggle('hidden', !isHidden);
                    eyeClosed.classList.toggle('hidden', isHidden);
                });
            };

            // Setup untuk field 'password'
            setupPasswordToggle('password', 'togglePassword');
        });
        </script>

        <div class="mt-6">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="flex justify-center mt-4 text-sm text-black">
            <span>Don't have an account?</span>
            <a href="{{ route('register') }}" class="ms-1 underline text-[#357DFF] hover:text-[#ff3c3c]">
                {{ __('Join Now For Free') }}
            </a>
        </div>

    </form>
</x-login-page-layout>
