@php
use Illuminate\Support\Str;
@endphp
<x-layouts.app :title="__('Buat Laporan Baru')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl mx-auto">
        <!-- Header Section with Tech Style -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-950 via-blue-900 to-cyan-900 p-8 shadow-2xl border border-blue-800/30">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnptMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAwYzMuMzE0IDAgNiAyLjY4NiA2IDZzLTIuNjg2IDYtNiA2LTYtMi42ODYtNi02IDIuNjg2LTYgNi02eiIgc3Ryb2tlPSJyZ2JhKDU5LCAxMzAsIDI0NiwgMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse"></div>
                    <span class="text-cyan-400 text-sm font-mono uppercase tracking-wider">Create New Report</span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">
                    <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                        Buat Laporan Baru
                    </span>
                </h1>
                <p class="text-blue-200 text-lg">Isi form di bawah untuk melaporkan masalah sarana dan prasarana</p>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-cyan-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        @if($errors->any())
            <div class="p-4 bg-gradient-to-r from-red-500/10 to-orange-500/10 border border-red-500/30 text-red-300 rounded-xl backdrop-blur-sm shadow-lg shadow-red-500/10">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold">Silakan perbaiki kesalahan berikut:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('reports.store') }}" class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-xl p-8 space-y-6">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10 space-y-6">
                @csrf

                <div>
                    <label for="category_id" class="block text-sm font-mono text-blue-300 uppercase tracking-wider mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-4 py-3 bg-slate-800/50 border border-blue-500/30 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:text-white backdrop-blur-sm transition-all text-white">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" class="bg-slate-800">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block text-sm font-mono text-blue-300 uppercase tracking-wider mb-2">
                        Judul Laporan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}"
                        placeholder="Contoh: Keyboard Rusak di Lab Komputer 1"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-blue-500/30 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:text-white backdrop-blur-sm transition-all text-white placeholder:text-slate-500">
                    @error('title')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-mono text-blue-300 uppercase tracking-wider mb-2">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="location" id="location" required value="{{ old('location') }}"
                        placeholder="Contoh: Lab Komputer 1, Gedung Teknik"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-blue-500/30 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:text-white backdrop-blur-sm transition-all text-white placeholder:text-slate-500">
                    @error('location')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-mono text-blue-300 uppercase tracking-wider mb-2">
                        Deskripsi Masalah <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description" rows="6" required
                        placeholder="Jelaskan masalah yang Anda temui secara detail..."
                        class="w-full px-4 py-3 bg-slate-800/50 border border-blue-500/30 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:text-white backdrop-blur-sm transition-all text-white placeholder:text-slate-500 resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-slate-400 font-mono">Minimal 10 karakter</p>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono">
                        ↓ Submit Laporan
                    </button>
                    <a href="{{ route('reports.my') }}" class="px-6 py-3 border border-blue-500/30 hover:border-cyan-400/80 rounded-xl hover:bg-blue-500/10 transition-all backdrop-blur-sm text-white font-medium">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
