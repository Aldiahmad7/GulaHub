@extends('layouts.auth')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Login</h2>
                    </div>

                    <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                        @csrf

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Gagal login!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope text-green-600 mr-2"></i>
                                Email
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 placeholder-gray-400"
                                placeholder="Masukkan email Anda">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-lock text-green-600 mr-2"></i>
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 placeholder-gray-400 pr-12"
                                    placeholder="Masukkan password Anda">
                                <button
                                    type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword()">
                                    <i id="passwordIcon" class="fas fa-eye text-gray-400 hover:text-green-600 transition duration-300"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 space-y-4">
                        <p class="text-center text-gray-600 font-medium">Belum punya akun? Daftar sebagai:</p>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('registerPetani') }}" class="flex-1 flex items-center justify-center px-4 py-3 border border-green-600 rounded-lg text-green-600 hover:bg-green-50 font-medium transition duration-300">
                                <i class="fas fa-seedling mr-2"></i>
                                Petani
                            </a>
                            <a href="{{ route('registerPabrik') }}" class="flex-1 flex items-center justify-center px-4 py-3 border border-green-600 rounded-lg text-green-600 hover:bg-green-50 font-medium transition duration-300">
                                <i class="fas fa-industry mr-2"></i>
                                Pabrik
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        document.getElementById('email').addEventListener('blur', function () {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email && !emailRegex.test(email)) {
                this.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                this.classList.remove('border-gray-300', 'focus:ring-green-500', 'focus:border-green-500');
            } else {
                this.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                this.classList.add('border-gray-300', 'focus:ring-green-500', 'focus:border-green-500');
            }
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Memproses...';

            setTimeout(() => {
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
                form.submit();
            }, 1000);
        });
    </script>
@endsection
