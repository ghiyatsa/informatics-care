@php
use Illuminate\Support\Str;
@endphp
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
                    <a href="{{ route('reports.create') }}" class="group px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono flex items-center gap-2 text-white font-bold">
                        <span class="text-white">+ Create</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

        @if(session('error'))
            <div class="p-4 bg-gradient-to-r from-red-500/10 to-orange-500/10 border border-red-500/30 text-red-300 rounded-xl backdrop-blur-sm shadow-lg shadow-red-500/10">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
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
                    <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono text-white font-bold">
                        <span class="text-white">Buat Laporan</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                </div>
            </div>
        @else
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-800/50 border-b border-slate-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @foreach($reports as $report)
                                <tr class="hover:bg-slate-800/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-white">{{ Str::limit($report->title, 40) }}</div>
                                        <div class="text-xs text-slate-400 font-mono">{{ $report->created_at->format('d M Y, H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-mono bg-blue-500/10 text-blue-400 rounded border border-blue-500/30">
                                            {{ $report->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-300 font-mono">{{ Str::limit($report->location, 20) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border
                                            @if($report->status->value === 'pending') bg-amber-500/10 text-amber-400 border-amber-500/30
                                            @elseif($report->status->value === 'in_progress') bg-blue-500/10 text-blue-400 border-blue-500/30
                                            @elseif($report->status->value === 'completed') bg-emerald-500/10 text-emerald-400 border-emerald-500/30
                                            @else bg-red-500/10 text-red-400 border-red-500/30
                                            @endif">
                                            @if($report->status->value === 'pending') ⏳ PENDING
                                            @elseif($report->status->value === 'in_progress') 🔄 IN PROGRESS
                                            @elseif($report->status->value === 'completed') ✓ COMPLETED
                                            @else ✕ REJECTED
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <button onclick="openDetailModal({{ $report->id }})"
                                                class="group relative px-3 py-1.5 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-500/30 hover:border-cyan-400/50 rounded-lg text-cyan-400 hover:text-cyan-300 text-xs font-mono font-semibold transition-all hover:shadow-lg hover:shadow-cyan-500/20 flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View
                                            </button>
                                            <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="group relative px-3 py-1.5 bg-gradient-to-r from-red-500/10 to-pink-500/10 border border-red-500/30 hover:border-red-400/50 rounded-lg text-red-400 hover:text-red-300 text-xs font-mono font-semibold transition-all hover:shadow-lg hover:shadow-red-500/20 flex items-center gap-1.5">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-800/30">
                    {{ $reports->links() }}
                </div>
            </div>
        @endif

        <!-- Modal Detail Laporan -->
        <div id="detailModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden items-center justify-center z-50 overflow-y-auto">
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-xl shadow-xl max-w-3xl w-full mx-4 my-8 p-6 border border-blue-500/20">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Detail Laporan
                    </h3>
                    <button onclick="closeDetailModal()" class="text-slate-400 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div id="detailContent" class="space-y-6">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>

        <script>
            function openDetailModal(reportId) {
                const modal = document.getElementById('detailModal');
                const content = document.getElementById('detailContent');

                // Show loading
                content.innerHTML = '<div class="text-center py-8"><div class="text-cyan-400">Memuat...</div></div>';
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                // Fetch report details
                fetch(`/admin/reports/${reportId}`)
                    .then(response => response.json())
                    .then(data => {
                        const report = data.report;
                        const statusBadge = getStatusBadge(report.status);
                        const createdAt = new Date(report.created_at).toLocaleString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        content.innerHTML = `
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="bg-slate-800/50 rounded-xl p-4 border border-blue-500/20">
                                    <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-1">ID Laporan</div>
                                    <div class="text-white font-semibold font-mono">#${report.id}</div>
                                </div>
                                <div class="bg-slate-800/50 rounded-xl p-4 border border-blue-500/20">
                                    <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-1">Status</div>
                                    <div>${statusBadge}</div>
                                </div>
                            </div>

                            <div class="bg-slate-800/50 rounded-xl p-4 border border-blue-500/20">
                                <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-2">Judul Laporan</div>
                                <div class="text-white font-semibold text-lg">${escapeHtml(report.title)}</div>
                            </div>

                            <div class="bg-slate-800/50 rounded-xl p-4 border border-blue-500/20">
                                <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-2">Deskripsi</div>
                                <div class="text-slate-300 whitespace-pre-wrap leading-relaxed max-h-96 overflow-y-auto">${escapeHtml(report.description)}</div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-slate-800/50 rounded-xl p-4 border border-blue-500/20">
                                    <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-2">Kategori</div>
                                    <div class="px-3 py-1.5 inline-block bg-blue-500/10 text-blue-400 rounded border border-blue-500/30 font-mono text-sm">
                                        ${escapeHtml(report.category.name)}
                                    </div>
                                </div>
                                <div class="bg-slate-800/50 rounded-xl p-4 border border-blue-500/20">
                                    <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-2">Lokasi</div>
                                    <div class="text-white">${escapeHtml(report.location)}</div>
                                </div>
                            </div>

                            <div class="bg-slate-800/50 rounded-xl p-4 border border-blue-500/20">
                                <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-2">Tanggal Dibuat</div>
                                <div class="text-white font-mono text-sm">${createdAt}</div>
                            </div>

                            ${report.admin_response ? `
                                <div class="bg-gradient-to-br from-blue-500/10 to-cyan-500/10 rounded-xl p-4 border border-blue-500/30">
                                    <div class="text-xs font-mono text-blue-300 uppercase tracking-wider mb-2">Respon Admin</div>
                                    <div class="text-cyan-300 whitespace-pre-wrap leading-relaxed">${escapeHtml(report.admin_response)}</div>
                                </div>
                            ` : ''}

                            <div class="flex gap-3 pt-4 border-t border-slate-700/50">
                                <button onclick="closeDetailModal()"
                                    class="flex-1 px-6 py-3 border border-blue-500/30 hover:border-cyan-400/80 rounded-xl hover:bg-blue-500/10 transition-all backdrop-blur-sm text-white font-medium">
                                    Tutup
                                </button>
                            </div>
                        `;
                    })
                    .catch(error => {
                        content.innerHTML = '<div class="text-center py-8"><div class="text-red-400">Gagal memuat data laporan</div></div>';
                        console.error('Error:', error);
                    });
            }

            function closeDetailModal() {
                const modal = document.getElementById('detailModal');
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }

            function getStatusBadge(status) {
                const statusMap = {
                    'pending': '<span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border bg-amber-500/10 text-amber-400 border-amber-500/30">⏳ PENDING</span>',
                    'in_progress': '<span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border bg-blue-500/10 text-blue-400 border-blue-500/30">🔄 IN PROGRESS</span>',
                    'completed': '<span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border bg-emerald-500/10 text-emerald-400 border-emerald-500/30">✓ COMPLETED</span>',
                    'rejected': '<span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border bg-red-500/10 text-red-400 border-red-500/30">✕ REJECTED</span>'
                };
                return statusMap[status] || statusMap['pending'];
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Close modal when clicking outside
            document.getElementById('detailModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDetailModal();
                }
            });
        </script>
    </div>
</x-layouts.app>

