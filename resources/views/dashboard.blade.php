<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        @php
            $user = auth()->user();
            // Optimized: Use single query with selectRaw to get all counts at once
            $reportStats = \App\Models\Report::selectRaw('
                COUNT(*) as total_reports,
                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as pending_reports,
                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as completed_reports
            ', ['pending', 'completed'])->first();

            $stats = [
                'total_reports' => $reportStats->total_reports ?? 0,
                'pending_reports' => $reportStats->pending_reports ?? 0,
                'completed_reports' => $reportStats->completed_reports ?? 0,
                'total_users' => \App\Models\User::where('role', \App\Enums\UserRole::User->value)->count(),
            ];
        @endphp

        <!-- Header Section with Tech Style -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-950 via-blue-900 to-cyan-900 p-8 shadow-2xl border border-blue-800/30">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnptMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAwYzMuMzE0IDAgNiAyLjY4NiA2IDZzLTIuNjg2IDYtNiA2LTYtMi42ODYtNi02IDIuNjg2LTYgNi02eiIgc3Ryb2tlPSJyZ2JhKDU5LCAxMzAsIDI0NiwgMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse"></div>
                    <span class="text-cyan-400 text-sm font-mono uppercase tracking-wider">System Status: Online</span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2 tracking-tight">
                    <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                        Informatics Care
                    </span>
                    <span class="text-white"> Dashboard</span>
                </h1>
                <p class="text-blue-200 text-lg">Selamat Datang, <span class="font-semibold text-cyan-300">{{ $user->name }}</span></p>
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

        <!-- Statistics Cards with Tech Design -->
        <div class="grid gap-6 md:grid-cols-4">
            <!-- Total Reports Card -->
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-xl shadow-blue-500/5 hover:shadow-blue-500/20 transition-all duration-300 hover:border-blue-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="px-2 py-1 text-xs font-mono text-blue-400 bg-blue-500/10 rounded border border-blue-500/20">TOTAL</span>
                    </div>
                    <p class="text-sm font-mono text-blue-300 uppercase tracking-wider mb-1">Total Laporan</p>
                    <p class="text-4xl font-bold text-white mb-2">{{ $stats['total_reports'] }}</p>
                    <div class="h-1 w-full bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full w-full bg-gradient-to-r from-blue-500 to-cyan-500 animate-pulse"></div>
                    </div>
                </div>
            </div>

            <!-- Pending Reports Card -->
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-amber-500/20 shadow-xl shadow-amber-500/5 hover:shadow-amber-500/20 transition-all duration-300 hover:border-amber-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="px-2 py-1 text-xs font-mono text-amber-400 bg-amber-500/10 rounded border border-amber-500/20">QUEUE</span>
                    </div>
                    <p class="text-sm font-mono text-amber-300 uppercase tracking-wider mb-1">Menunggu</p>
                    <p class="text-4xl font-bold text-white mb-2">{{ $stats['pending_reports'] }}</p>
                    <div class="h-1 w-full bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full w-2/3 bg-gradient-to-r from-amber-500 to-orange-500 animate-pulse"></div>
                    </div>
                </div>
            </div>

            <!-- Completed Reports Card -->
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-emerald-500/20 shadow-xl shadow-emerald-500/5 hover:shadow-emerald-500/20 transition-all duration-300 hover:border-emerald-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="px-2 py-1 text-xs font-mono text-emerald-400 bg-emerald-500/10 rounded border border-emerald-500/20">DONE</span>
                    </div>
                    <p class="text-sm font-mono text-emerald-300 uppercase tracking-wider mb-1">Selesai</p>
                    <p class="text-4xl font-bold text-white mb-2">{{ $stats['completed_reports'] }}</p>
                    <div class="h-1 w-full bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full w-4/5 bg-gradient-to-r from-emerald-500 to-green-500 animate-pulse"></div>
                    </div>
                </div>
            </div>

            <!-- Total Users Card -->
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-purple-500/20 shadow-xl shadow-purple-500/5 hover:shadow-purple-500/20 transition-all duration-300 hover:border-purple-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="px-2 py-1 text-xs font-mono text-purple-400 bg-purple-500/10 rounded border border-purple-500/20">USERS</span>
                    </div>
                    <p class="text-sm font-mono text-purple-300 uppercase tracking-wider mb-1">Total User</p>
                    <p class="text-4xl font-bold text-white mb-2">{{ $stats['total_users'] }}</p>
                    <div class="h-1 w-full bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full w-3/5 bg-gradient-to-r from-purple-500 to-pink-500 animate-pulse"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions with Tech Style -->
        <div class="grid gap-6 md:grid-cols-3">
            <a href="{{ route('admin.reports.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-cyan-500/20 hover:border-cyan-500/50 shadow-xl hover:shadow-cyan-500/20 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/0 via-cyan-500/5 to-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative p-6">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-white text-lg mb-1">Manajemen Laporan</h3>
                            <p class="text-sm text-slate-400 font-mono">Kelola semua laporan sistem</p>
                        </div>
                        <svg class="w-6 h-6 text-cyan-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 hover:border-blue-500/50 shadow-xl hover:shadow-blue-500/20 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/0 via-blue-500/5 to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative p-6">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-white text-lg mb-1">Manajemen Kategori</h3>
                            <p class="text-sm text-slate-400 font-mono">Kelola kategori laporan</p>
                        </div>
                        <svg class="w-6 h-6 text-blue-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-purple-500/20 hover:border-purple-500/50 shadow-xl hover:shadow-purple-500/20 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/0 via-purple-500/5 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative p-6">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-white text-lg mb-1">Manajemen User</h3>
                            <p class="text-sm text-slate-400 font-mono">Kelola pengguna sistem</p>
                        </div>
                        <svg class="w-6 h-6 text-purple-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Reports with Tech Design -->
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-2xl shadow-blue-500/5">
            <div class="p-6 border-b border-slate-700/50">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">Laporan Terbaru</h2>
                        <p class="text-sm text-slate-400 font-mono">Data terkini dari sistem</p>
                    </div>
                    <a href="{{ route('admin.reports.index') }}" class="group flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:shadow-lg hover:shadow-cyan-500/30 transition-all font-medium">
                        <span>Kelola Laporan</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>

            @php
                $recentReports = \App\Models\Report::with(['user', 'category'])->latest()->take(5)->get();
            @endphp

            <div class="p-6">
                @if($recentReports->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <p class="text-slate-500 font-mono">Tidak ada laporan saat ini</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($recentReports as $report)
                            <div class="group relative overflow-hidden bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-4 hover:border-cyan-500/30 hover:shadow-lg hover:shadow-cyan-500/10 transition-all duration-300">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-white text-lg mb-2 truncate">{{ $report->title }}</h4>
                                        <div class="flex flex-wrap items-center gap-3 text-sm">
                                            <span class="flex items-center gap-1 text-slate-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                {{ $report->user->name }}
                                            </span>
                                            <span class="w-1 h-1 bg-slate-600 rounded-full"></span>
                                            <span class="px-2 py-1 bg-blue-500/10 text-blue-400 rounded border border-blue-500/20 font-mono text-xs">
                                                {{ $report->category->name }}
                                            </span>
                                            <span class="w-1 h-1 bg-slate-600 rounded-full"></span>
                                            <span class="flex items-center gap-1 text-slate-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $report->location }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border
                                            @if($report->status->value === 'pending') bg-amber-500/10 text-amber-400 border-amber-500/30
                                            @elseif($report->status->value === 'in_progress') bg-blue-500/10 text-blue-400 border-blue-500/30
                                            @elseif($report->status->value === 'completed') bg-emerald-500/10 text-emerald-400 border-emerald-500/30
                                            @else bg-red-500/10 text-red-400 border-red-500/30
                                            @endif">
                                            @if($report->status->value === 'pending') ⏳ PENDING
                                            @elseif($report->status->value === 'in_progress') 🔄 PROGRESS
                                            @elseif($report->status->value === 'completed') ✓ DONE
                                            @else ✕ REJECTED
                                            @endif
                                        </span>
                                        <span class="text-xs text-slate-500 font-mono">{{ $report->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
