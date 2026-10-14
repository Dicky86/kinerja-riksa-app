<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Kinerja Riksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 w-full max-w-md p-8 md:p-10">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800 mb-1">Buat Akun Baru</h1>
            <p class="text-slate-500 text-sm">Daftarkan diri Anda untuk menggunakan sistem</p>
        </div>

        <!-- Form mengarah kembali ke Login setelah mendaftar -->
        <form action="{{ route('login') }}" method="GET">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none" placeholder="Masukkan nama Anda">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none" placeholder="Masukkan email aktif">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                    <input type="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none" placeholder="Buat password">
                </div>
                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3.5 rounded-xl transition duration-200 mt-4">
                    Daftar
                </button>
            </div>
        </form>

        <div class="mt-8 text-center text-sm text-slate-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-700 transition">Masuk di sini</a>
        </div>

    </div>
</body>
</html>