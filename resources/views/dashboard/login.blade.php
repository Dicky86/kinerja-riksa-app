<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kinerja Riksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 w-full max-w-md p-8 md:p-10">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#eef2ff] text-blue-600 mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800 mb-1">Selamat Datang</h1>
            <p class="text-slate-500 text-sm">Silakan masuk untuk mengakses Kinerja Riksa</p>
        </div>

        <form action="{{ route('dashboard.index') }}" method="GET">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email atau Username</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none" placeholder="Masukkan email">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                    <input type="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none" placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-[#3b82f6] hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition duration-200 mt-4">
                    Masuk
                </button>
            </div>
        </form>

        <!-- Tambahan Link ke Halaman Daftar -->
        <div class="mt-8 text-center text-sm text-slate-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-700 transition">Daftar sekarang</a>
        </div>

    </div>
</body>
</html>