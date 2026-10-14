<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinerja Riksa - Kemnaker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        .font-serif-title { font-family: 'Merriweather', serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-[1200px] flex flex-col md:flex-row overflow-hidden min-h-[600px]">
        
        <!-- Bagian Kiri (Teks & Tombol) -->
        <div class="w-full md:w-1/2 p-10 md:p-16 lg:p-20 flex flex-col justify-center">
            
            <!-- Logo Asli Kemnaker (Posisi kembali rata kiri, diperbesar sedikit) -->
            <div class="mb-8">
                <img src="{{ asset('images/logo-kemnaker.png') }}" alt="Logo Kemnaker" class="w-20 md:w-24 h-auto object-contain">
            </div>

            <h2 class="text-teal-700 font-bold text-xs tracking-[0.15em] uppercase mb-4">KEMENTERIAN KETENAGAKERJAAN</h2>
            <h1 class="text-4xl md:text-5xl font-black text-[#1e293b] font-serif-title mb-6 tracking-tight">KINERJA RIKSA</h1>
            
            <p class="text-slate-500 text-base md:text-lg leading-relaxed mb-10 pr-0 md:pr-4">
                Ruang kerja ringkas untuk mengunggah, memeriksa, dan memantau capaian secara terstruktur dalam satu dashboard.
            </p>

            <div>
                <!-- Tombol ini mengarah ke Halaman Login -->
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-[#3b82f6] hover:bg-blue-700 text-white font-semibold py-3.5 px-6 rounded-xl transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                    Masuk ke Dashboard
                </a>
            </div>
        </div>

        <!-- Bagian Kanan (Gambar Gedung) -->
        <div class="w-full md:w-1/2 relative hidden md:block">
            <!-- Gambar menggunakan gedung.png -->
            <img src="{{ asset('images/gedung.png') }}" alt="Gedung Kemnaker" class="absolute inset-0 w-full h-full object-cover">
        </div>

    </div>
</body>
</html>