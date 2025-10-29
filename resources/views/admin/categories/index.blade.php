@php
use Illuminate\Support\Str;
@endphp
<x-layouts.app :title="__('Manajemen Kategori')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header Section with Tech Style -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-950 via-blue-900 to-cyan-900 p-8 shadow-2xl border border-blue-800/30">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnptMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAwYzMuMzE0IDAgNiAyLjY4NiA2IDZzLTIuNjg2IDYtNiA2LTYtMi42ODYtNi02IDIuNjg2LTYgNi02eiIgc3Ryb2tlPSJyZ2JhKDU5LCAxMzAsIDI0NiwgMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse"></div>
                            <span class="text-cyan-400 text-sm font-mono uppercase tracking-wider">Category Management</span>
                        </div>
                        <h1 class="text-4xl font-bold text-white mb-2">
                            <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                                Manajemen Kategori
                            </span>
                        </h1>
                        <p class="text-blue-200 text-lg">Kelola kategori laporan</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-blue-500/30 hover:border-cyan-400/80 rounded-xl hover:bg-blue-500/10 transition-all backdrop-blur-sm text-white font-medium">
                            ← Dashboard
                        </a>
                        <a href="{{ route('admin.categories.create') }}" class="group px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono flex items-center gap-2">
                            <span>+ Add Category</span>
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
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

        @if($categories->isEmpty())
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 p-12 text-center shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-cyan-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Kategori</h3>
                    <p class="text-slate-400 mb-6">Tambah kategori pertama untuk memulai</p>
                    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono">
                        <span>Tambah Kategori</span>
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
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Jumlah Laporan</th>
                                <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @foreach($categories as $category)
                                <tr class="hover:bg-slate-800/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-white">{{ $category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-300">
                                        {{ Str::limit($category->description, 60) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-mono font-semibold bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/30">
                                            {{ $category->reports_count }} laporan
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.categories.show', $category) }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-mono transition">View</a>
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-400 hover:text-blue-300 text-sm font-mono transition">Edit</a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-mono transition">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-800/30">
                    {{ $categories->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
