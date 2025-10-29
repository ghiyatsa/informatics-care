<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 antialiased">
        <!-- Animated Background -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-20 left-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <!-- Grid Pattern -->
        <div class="fixed inset-0 opacity-10 pointer-events-none" style="background-image:
            linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;">
        </div>

        <div class="relative z-10 flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="w-full max-w-md">
                <!-- Logo Section -->
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-3 mb-8 group" wire:navigate>
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-2xl flex items-center justify-center shadow-2xl shadow-blue-500/50 group-hover:scale-110 transition-transform">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-400 via-cyan-300 to-blue-400 bg-clip-text text-transparent group-hover:from-cyan-300 group-hover:via-blue-400 group-hover:to-cyan-300 transition-all">
                        Informatics Care
                    </h1>
                    <p class="text-sm text-blue-300/70 font-mono">Platform Pelaporan Terpadu</p>
                </a>

                <!-- Auth Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-2xl p-8 backdrop-blur-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute -right-20 -top-20 w-40 h-40 bg-cyan-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute -left-20 -bottom-20 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>

                    <div class="relative z-10">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Footer -->
                <p class="text-center text-xs text-blue-300/50 mt-6 font-mono">
                    © 2025 Informatics Care - Universitas Malikussaleh
                </p>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
