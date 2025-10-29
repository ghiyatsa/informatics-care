<x-layouts.app :title="__('Laporan Saya')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header Section with Tech Style -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-950 via-blue-900 to-cyan-900 p-8 shadow-2xl border border-blue-800/30">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnptMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAwYzMuMzE0IDAgNiAyLjY4NiA2IDZzLTIuNjg2IDYtNiA2LTYtMi42ODYtNi02IDIuNjg2LTYgNi02eiIgc3Ryb2tlPSJyZ2JhKDU5LCAxMzAsIDI0NiwgMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse"></div>
                            <span class="text-cyan-400 text-sm font-mono uppercase tracking-wider">My Reports</span>
                        </div>
                        <h1 class="text-4xl font-bold text-white">
                            <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                                Laporan Saya
                            </span>
                        </h1>
                        <p class="text-blue-200 text-lg mt-2">Selamat Datang, <span class="font-semibold text-cyan-300">{{ auth()->user()->name }}</span>!</p>
                        <p class="text-blue-300/70 text-sm font-mono">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('reports.create') }}" class="group px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono flex items-center gap-2">
                        <span>+ Create</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-cyan-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-500/30 text-cyan-300 rounded-xl backdrop-blur-sm shadow-lg shadow-cyan-500/10">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($reports->isEmpty())
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 p-12 text-center shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-cyan-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Laporan</h3>
                    <p class="text-slate-400 mb-6">Mulai dengan membuat laporan pertama Anda</p>
                    <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono">
                        <span>Buat Laporan</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                </div>
            </div>
        @else
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-2xl">
                <div class="space-y-3 p-6">
                    @foreach($reports as $report)
                        <div class="group relative overflow-hidden bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:border-cyan-500/30 hover:shadow-lg hover:shadow-cyan-500/10 transition-all duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/0 to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-white mb-3">{{ $report->title }}</h3>
                                        <div class="flex flex-wrap items-center gap-3 text-sm">
                                            <span class="flex items-center gap-2 text-slate-400">
                                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                                </svg>
                                                {{ $report->category->name }}
                                            </span>
                                            <span class="w-1 h-1 bg-slate-600 rounded-full"></span>
                                            <span class="flex items-center gap-2 text-slate-400">
                                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $report->location }}
                                            </span>
                                            <span class="w-1 h-1 bg-slate-600 rounded-full"></span>
                                            <span class="flex items-center gap-2 text-slate-400">
                                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $report->created_at->format('d M Y, H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="ml-4 px-3 py-1.5 rounded-lg text-xs font-mono font-medium border
                                        @if($report->status === 'pending') bg-amber-500/10 text-amber-400 border-amber-500/30
                                        @elseif($report->status === 'in_progress') bg-blue-500/10 text-blue-400 border-blue-500/30
                                        @elseif($report->status === 'completed') bg-emerald-500/10 text-emerald-400 border-emerald-500/30
                                        @else bg-red-500/10 text-red-400 border-red-500/30
                                        @endif">
                                        @if($report->status === 'pending') ⏳ PENDING
                                        @elseif($report->status === 'in_progress') 🔄 IN PROGRESS
                                        @elseif($report->status === 'completed') ✓ COMPLETED
                                        @else ✕ REJECTED
                                        @endif
                                    </span>
                                </div>

                                <p class="text-slate-300 mb-4 leading-relaxed">{{ $report->description }}</p>

                                @if($report->admin_response)
                                    <div class="mt-4 p-4 bg-gradient-to-br from-blue-500/10 to-cyan-500/10 border border-blue-500/30 rounded-xl">
                                        <p class="text-sm font-semibold text-cyan-300 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Respons Admin:
                                        </p>
                                        <p class="text-sm text-blue-300">{{ $report->admin_response }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-800/30">
                    {{ $reports->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
