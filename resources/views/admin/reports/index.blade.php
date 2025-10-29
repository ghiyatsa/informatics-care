@php
use Illuminate\Support\Str;
@endphp
<x-layouts.app :title="__('Manajemen Laporan')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header Section with Tech Style -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-950 via-blue-900 to-cyan-900 p-8 shadow-2xl border border-blue-800/30">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnptMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAwYzMuMzE0IDAgNiAyLjY4NiA2IDZzLTIuNjg2IDYtNiA2LTYtMi42ODYtNi02IDIuNjg2LTYgNi02eiIgc3Ryb2tlPSJyZ2JhKDU5LCAxMzAsIDI0NiwgMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse"></div>
                            <span class="text-cyan-400 text-sm font-mono uppercase tracking-wider">Report Management</span>
                        </div>
                        <h1 class="text-4xl font-bold text-white mb-2">
                            <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                                Manajemen Laporan
                            </span>
                        </h1>
                        <p class="text-blue-200 text-lg">Kelola semua laporan dari pengguna</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-blue-500/30 hover:border-cyan-400/80 rounded-xl hover:bg-blue-500/10 transition-all backdrop-blur-sm text-white font-medium">
                            Categories
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-blue-500/30 hover:border-cyan-400/80 rounded-xl hover:bg-blue-500/10 transition-all backdrop-blur-sm text-white font-medium">
                            Users
                        </a>
                    </div>
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
                    <p class="text-slate-400">Sistem siap menerima laporan</p>
                </div>
            </div>
        @else
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-800/50 border-b border-slate-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">User</th>
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
                                    <td class="px-6 py-4 text-sm text-slate-300">{{ $report->user->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-mono bg-blue-500/10 text-blue-400 rounded border border-blue-500/30">
                                            {{ $report->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-300 font-mono">{{ Str::limit($report->location, 20) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border
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
                                    </td>
                                    <td class="px-6 py-4">
                                        <button onclick="openModal({{ $report->id }}, '{{ $report->status }}')"
                                            class="px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-lg hover:shadow-lg hover:shadow-cyan-500/30 transition text-white text-sm font-mono font-semibold">
                                            Update
                                        </button>
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
    </div>

    <!-- Modal Update Status -->
    <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-xl shadow-xl max-w-md w-full p-6 border border-blue-500/20">
            <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Update Status Laporan
            </h3>
            <form id="statusForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-mono text-blue-300 uppercase tracking-wider mb-2">Status</label>
                    <select name="status" id="modalStatus" class="w-full px-4 py-3 bg-slate-800/50 border border-blue-500/30 rounded-xl text-white font-mono" required>
                        <option value="pending" class="bg-slate-800">⏳ Menunggu</option>
                        <option value="in_progress" class="bg-slate-800">🔄 Dalam Proses</option>
                        <option value="completed" class="bg-slate-800">✓ Selesai</option>
                        <option value="rejected" class="bg-slate-800">✕ Ditolak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-mono text-blue-300 uppercase tracking-wider mb-2">Respons (Opsional)</label>
                    <textarea name="admin_response" id="adminResponse" rows="3"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-blue-500/30 rounded-xl text-white font-mono resize-none"
                        placeholder="Berikan respons atau catatan..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition font-semibold font-mono text-white">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()" class="px-6 py-3 border border-blue-500/30 hover:border-cyan-400/80 rounded-xl hover:bg-blue-500/10 transition-all backdrop-blur-sm text-white font-medium">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(reportId, currentStatus) {
            const modal = document.getElementById('statusModal');
            const form = document.getElementById('statusForm');
            const statusSelect = document.getElementById('modalStatus');

            form.action = `/admin/reports/${reportId}/update-status`;
            statusSelect.value = currentStatus;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('statusModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('statusModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</x-layouts.app>
