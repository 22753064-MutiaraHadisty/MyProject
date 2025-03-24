<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .primary-bg {
            background-color: #191970;
        }
    </style>
</head>

<body class="primary-bg text-white flex flex-col items-center justify-center min-h-screen p-6">

    <!-- Header -->
    <header class="w-full max-w-4xl text-sm mb-6">
        @if (Route::has('login'))
            <nav class="flex items-center justify-between flex-wrap">
                <h1 class="text-xl font-semibold text-white">Welcome to Laravel</h1>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-5 py-2 border border-white hover:border-gray-300 text-white rounded-md text-sm">
                            Dashboard
                        </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-900 transition-all">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-900 transition-all">
                            Register
                        </a>
                    @endif
                @endauth

                <a href="{{ route('pendaftaran.create') }}"
                    class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-900 transition-all">
                    Register Student
                </a>

                </div>
            </nav>
        @endif
    </header>

    <!-- Form Pencarian -->
    <div class="w-full max-w-4xl bg-gray-900 p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-semibold text-center mb-4 text-white">Cari Pendaftaran</h2>
        <form action="{{ route('pendaftaran.search') }}" method="GET" class="flex gap-2">
            <input type="text" name="query" placeholder="Cari NISN atau Nama..."
                class="w-full px-4 py-2 border rounded-md text-sm focus:ring-2 focus:ring-blue-500 bg-gray-800 text-white border-gray-600">
            <button type="submit" class="px-4 py-2 bg-[#191970] text-white rounded-md text-sm hover:bg-[#11115e] transition-all">
                Cari
            </button>

        </form>
    </div>

    <!-- Spacer -->
    @if (Route::has('login'))
        <div class="h-14 hidden lg:block"></div>
    @endif

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

</body>

</html>