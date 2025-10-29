<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    @include('partials.head')
    <title>Informatics Care - Pelaporan Masalah Sarana dan Prasarana</title>
    <style>
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .grid-pattern {
            background-image:
                linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 text-white overflow-x-hidden">
    <div class="min-h-screen relative">
        <!-- Animated Background Grid -->
        <div class="fixed inset-0 opacity-20 pointer-events-none grid-pattern"></div>

        <!-- Floating Orbs -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-20 left-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        </div>

        <!-- Header -->
        <header class="relative border-b border-blue-500/20 backdrop-blur-md bg-slate-950/50 z-50">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/50">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                            Informatics Care
                        </h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-blue-300 hover:text-blue-200 transition-colors font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-blue-300 hover:text-blue-200 transition-colors font-medium">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 rounded-lg font-semibold transition-all transform hover:scale-105 shadow-lg shadow-blue-500/50">
                                Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="relative py-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center">
                    <!-- Glowing Badge -->
                    <div class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-500/10 border border-blue-500/30 rounded-full mb-8 backdrop-blur-sm animate-float">
                        <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                        <span class="text-sm text-blue-300 font-medium">Platform Pelaporan Terpadu</span>
                    </div>

                    <h2 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-blue-400 via-cyan-300 to-blue-500 bg-clip-text text-transparent">
                            Selamat Datang di
                        </span>
                        <br />
                        <span class="bg-gradient-to-r from-cyan-300 to-blue-400 bg-clip-text text-transparent">
                            Informatics Care
                        </span>
                    </h2>

                    <p class="text-xl md:text-2xl mb-12 text-blue-200/80 max-w-3xl mx-auto leading-relaxed">
                        Platform pelaporan masalah sarana dan prasarana berbasis teknologi masa depan di Prodi Teknik Informatika Universitas Malikussaleh
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-20">
                        @auth
                            <a href="{{ route('dashboard') }}" class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-2xl shadow-blue-500/50 overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center">
                                    Lihat Dashboard
                                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-2xl shadow-blue-500/50 overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center">
                                    Buat Laporan
                                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </a>

                            <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-blue-500/50 hover:border-cyan-400/80 rounded-xl font-semibold transition-all backdrop-blur-sm hover:bg-blue-500/10 flex items-center justify-center">
                                Masuk
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                        @endauth
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto">
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-cyan-500/20 rounded-lg blur group-hover:blur-xl transition-all"></div>
                            <div class="relative bg-slate-900/50 border border-blue-500/30 rounded-lg p-6 backdrop-blur-sm">
                                <div class="text-4xl font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                                    500+
                                </div>
                                <div class="text-sm text-blue-300/70 mt-2">Laporan Terselesaikan</div>
                            </div>
                        </div>

                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-cyan-500/20 rounded-lg blur group-hover:blur-xl transition-all"></div>
                            <div class="relative bg-slate-900/50 border border-blue-500/30 rounded-lg p-6 backdrop-blur-sm">
                                <div class="text-4xl font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                                    98%
                                </div>
                                <div class="text-sm text-blue-300/70 mt-2">Tingkat Kepuasan</div>
                            </div>
                        </div>

                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-cyan-500/20 rounded-lg blur group-hover:blur-xl transition-all"></div>
                            <div class="relative bg-slate-900/50 border border-blue-500/30 rounded-lg p-6 backdrop-blur-sm">
                                <div class="text-4xl font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                                    24/7
                                </div>
                                <div class="text-sm text-blue-300/70 mt-2">Sistem Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="relative py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                        Fitur Unggulan
                    </h2>
                    <p class="text-blue-300/70 text-lg">Teknologi canggih untuk pengalaman pelaporan yang optimal</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-cyan-400 opacity-0 group-hover:opacity-20 rounded-2xl blur-xl transition-all duration-300"></div>

                        <div class="relative bg-slate-900/50 border border-blue-500/30 rounded-2xl p-8 backdrop-blur-sm hover:border-cyan-400/50 transition-all duration-300 h-full">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-blue-500/50">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>

                            <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-cyan-300 transition-colors">
                                Buat Laporan
                            </h3>

                            <p class="text-blue-300/70 leading-relaxed mb-6">
                                Interface intuitif dengan AI assistant untuk membantu pelaporan masalah sarana dan prasarana
                            </p>

                            <div class="flex items-center text-cyan-400 font-medium group-hover:translate-x-2 transition-transform">
                                Pelajari lebih lanjut
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 to-blue-400 opacity-0 group-hover:opacity-20 rounded-2xl blur-xl transition-all duration-300"></div>

                        <div class="relative bg-slate-900/50 border border-blue-500/30 rounded-2xl p-8 backdrop-blur-sm hover:border-cyan-400/50 transition-all duration-300 h-full">
                            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-400 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/50">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>

                            <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-cyan-300 transition-colors">
                                Lacak Status Real-time
                            </h3>

                            <p class="text-blue-300/70 leading-relaxed mb-6">
                                Dashboard monitoring dengan update real-time dan notifikasi instan untuk setiap perubahan status
                            </p>

                            <div class="flex items-center text-cyan-400 font-medium group-hover:translate-x-2 transition-transform">
                                Pelajari lebih lanjut
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-cyan-500 opacity-0 group-hover:opacity-20 rounded-2xl blur-xl transition-all duration-300"></div>

                        <div class="relative bg-slate-900/50 border border-blue-500/30 rounded-2xl p-8 backdrop-blur-sm hover:border-cyan-400/50 transition-all duration-300 h-full">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-blue-500/50">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>

                            <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-cyan-300 transition-colors">
                                Keamanan Tingkat Tinggi
                            </h3>

                            <p class="text-blue-300/70 leading-relaxed mb-6">
                                Enkripsi end-to-end dengan autentikasi multi-faktor menggunakan Google OAuth dan email mahasiswa
                            </p>

                            <div class="flex items-center text-cyan-400 font-medium group-hover:translate-x-2 transition-transform">
                                Pelajari lebih lanjut
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="relative py-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                        Cara Kerja
                    </h2>
                    <p class="text-blue-300/70 text-lg">Proses sederhana dalam 4 langkah</p>
                </div>

                <div class="grid md:grid-cols-4 gap-6">
                    <!-- Step 1 -->
                    <div class="relative group">
                        <div class="relative">
                            <div class="bg-slate-900/50 border border-blue-500/30 rounded-2xl p-6 backdrop-blur-sm hover:border-cyan-400/50 transition-all duration-300 h-full">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/50 group-hover:scale-110 transition-transform">
                                    <span class="text-2xl font-bold">01</span>
                                </div>

                                <h3 class="text-xl font-bold mb-3 text-center text-white">
                                    Daftar/Login
                                </h3>

                                <p class="text-blue-300/70 text-sm text-center leading-relaxed">
                                    Autentikasi dengan email mahasiswa atau Google
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative group">
                        <div class="relative">
                            <div class="bg-slate-900/50 border border-blue-500/30 rounded-2xl p-6 backdrop-blur-sm hover:border-cyan-400/50 transition-all duration-300 h-full">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/50 group-hover:scale-110 transition-transform">
                                    <span class="text-2xl font-bold">02</span>
                                </div>

                                <h3 class="text-xl font-bold mb-3 text-center text-white">
                                    Isi Form
                                </h3>

                                <p class="text-blue-300/70 text-sm text-center leading-relaxed">
                                    Deskripsikan masalah dengan detail dan lampirkan foto
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative group">
                        <div class="relative">
                            <div class="bg-slate-900/50 border border-blue-500/30 rounded-2xl p-6 backdrop-blur-sm hover:border-cyan-400/50 transition-all duration-300 h-full">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/50 group-hover:scale-110 transition-transform">
                                    <span class="text-2xl font-bold">03</span>
                                </div>

                                <h3 class="text-xl font-bold mb-3 text-center text-white">
                                    Tunggu Review
                                </h3>

                                <p class="text-blue-300/70 text-sm text-center leading-relaxed">
                                    Sistem AI & admin akan meninjau laporan Anda
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative group">
                        <div class="relative">
                            <div class="bg-slate-900/50 border border-blue-500/30 rounded-2xl p-6 backdrop-blur-sm hover:border-cyan-400/50 transition-all duration-300 h-full">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/50 group-hover:scale-110 transition-transform">
                                    <span class="text-2xl font-bold">04</span>
                                </div>

                                <h3 class="text-xl font-bold mb-3 text-center text-white">
                                    Dapatkan Update
                                </h3>

                                <p class="text-blue-300/70 text-sm text-center leading-relaxed">
                                    Terima notifikasi real-time tentang progress
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-3xl blur-2xl opacity-30"></div>

                    <div class="relative bg-slate-900/80 border border-blue-500/50 rounded-3xl p-12 backdrop-blur-xl text-center">
                        <h2 class="text-4xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                            Siap Untuk Memulai?
                        </h2>

                        <p class="text-blue-300/80 text-lg mb-8 max-w-2xl mx-auto">
                            Bergabunglah dengan ratusan mahasiswa yang telah merasakan kemudahan dalam melaporkan masalah kampus
                        </p>

                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-2xl shadow-blue-500/50">
                                Buka Dashboard
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-2xl shadow-blue-500/50">
                                Mulai Sekarang
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative border-t border-blue-500/20 backdrop-blur-md bg-slate-950/50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/50">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                            Informatics Care
                        </span>
                    </div>

                    <p class="text-blue-400/60 text-sm">
                        © 2025 Informatics Care. Prodi Teknik Informatika - Universitas Malikussaleh
                    </p>

                    <p class="text-blue-500/40 text-xs mt-2">
                        Powered by Next-Gen Technology
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
