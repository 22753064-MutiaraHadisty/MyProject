<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pendaftaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-effect {
            background: #191970;
            border: 1px solid rgba(250, 245, 245, 0.99);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="glass-effect p-8 rounded-2xl shadow-2xl w-full max-w-lg">
        <h2 class="text-4xl font-bold text-center text-white mb-6">Cek Status Pendaftaran</h2>

        <form action="{{ route('search') }}" method="GET" class="space-y-6">
            <div>
                <label for="query" class="block text-white font-medium text-lg">Masukkan Nama atau NISN</label>
                <input type="text" id="query" name="query" value="{{ request('query') }}"
                    class="w-full px-5 py-3 mt-2 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none text-gray-800 placeholder-gray-500 transition-all duration-300 text-lg"
                    placeholder="Contoh: 123456789 atau Nama Siswa" required>
            </div>
        </form>

        @if(isset($pendaftaran))
            <form class="mt-8 p-6 glass-effect rounded-2xl shadow text-center">
                <h3 class="text-2xl font-semibold text-white">Hasil Pencarian</h3>
                <div class="text-left mt-4">
                    <label class="block text-white font-medium text-lg">Nama:</label>
                    <input type="text" value="{{ $pendaftaran->nama }}"
                        class="w-full px-5 py-3 border border-gray-300 bg-gray-100 rounded-lg text-gray-800 text-lg"
                        readonly>
                </div>
                <div class="text-left mt-4">
                    <label class="block text-white font-medium text-lg">NISN:</label>
                    <input type="text" value="{{ $pendaftaran->nisn }}"
                        class="w-full px-5 py-3 border border-gray-300 bg-gray-100 rounded-lg text-gray-800 text-lg"
                        readonly>
                </div>
                <div class="text-left mt-4">
                    <label class="block text-white font-medium text-lg">Status:</label>
                    <input type="text" value="{{ ucfirst($pendaftaran->status) }}"
                        class="w-full px-5 py-3 border border-gray-300 bg-gray-100 rounded-lg text-gray-800 text-lg"
                        readonly>
                </div>
            </form>
        @elseif(request()->has('query'))
            <div class="mt-8 p-6 bg-red-500 bg-opacity-30 glass-effect rounded-2xl shadow text-center">
                <p class="text-white font-semibold text-lg">Data tidak ditemukan.</p>
            </div>
        @endif
    </div>
</body>

</html>