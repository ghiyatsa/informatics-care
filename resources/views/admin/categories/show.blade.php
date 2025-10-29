@php
use Illuminate\Support\Str;
@endphp
<x-layouts.app :title="__('Detail Kategori')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Kategori</h1>
                <p class="text-gray-600 dark:text-gray-400">Informasi kategori {{ $category->name }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Kembali
                </a>
                <a href="{{ route('admin.categories.edit', $category) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Edit
                </a>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- Category Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Kategori</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $category->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $category->description ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Laporan</dt>
                        <dd class="mt-1">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                {{ $category->reports_count }} laporan
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $category->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Terakhir Update</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $category->updated_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksi</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="block w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center">
                        Edit Kategori
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Semua laporan di kategori ini juga akan terpengaruh.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Hapus Kategori
                        </button>
                    </form>
                </div>
            </div>

            <!-- Reports in this category -->
            <div class="col-span-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Laporan dalam Kategori Ini</h3>
                    <a href="{{ route('admin.reports.index') }}" class="text-sm text-blue-600 hover:underline">
                        Lihat Semua →
                    </a>
                </div>
                @if($reports->isEmpty())
                    <p class="text-gray-500">Belum ada laporan dalam kategori ini</p>
                @else
                    <div class="space-y-3">
                        @foreach($reports as $report)
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $report->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $report->user->name }} • {{ $report->location }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($report->status === 'in_progress') bg-blue-100 text-blue-800
                                        @elseif($report->status === 'completed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>

