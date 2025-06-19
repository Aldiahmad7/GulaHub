@extends('layouts.auth')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-md w-full space-y-8">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Daftar sebagai Petani</h2>
                    </div>

                    <form class="space-y-6" action="{{ route('register.petani.post') }}" method="POST">
                        @csrf

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Gagal mendaftar!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user text-green-600 mr-2"></i>
                                Nama Lengkap
                            </label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 placeholder-gray-400"
                                placeholder="Masukkan nama pabrik">
                        </div>

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
                                placeholder="Masukkan email">
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                                Alamat Lengkap
                            </label>
                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="3"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 placeholder-gray-400 resize-none"
                                placeholder="Masukkan alamat lengkap"
                            ></textarea>
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
                                    autocomplete="new-password"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 placeholder-gray-400 pr-12"
                                    placeholder="Masukkan Password">
                                <button
                                    type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('password')">
                                    <i id="passwordIcon" class="fas fa-eye text-gray-400 hover:text-green-600 transition duration-300"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                                Daftar sebagai Petani
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center space-y-3">
                        <p class="text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-medium transition duration-300">
                                Login di sini
                            </a>
                        </p>
                        <p class="text-gray-600">
                            Atau
                            <a href="{{ route('registerPabrik') }}" class="text-green-600 hover:text-green-700 font-medium transition duration-300">
                                Daftar sebagai Pabrik
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(inputId + 'Icon');

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

        document.getElementById('email').addEventListener('blur', function() {
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

        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;

            submitBtn.innerHTML = 'Mendaftarkan...';
            submitBtn.disabled = true;

            setTimeout(() => {
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;

                form.submit();
            }, 2000);
        });
    </script>
@endsection
