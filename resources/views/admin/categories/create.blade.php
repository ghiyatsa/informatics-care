@php
use Illuminate\Support\Str;
@endphp
<x-layouts.app :title="__('Tambah Kategori')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Kategori Baru</h1>
                <p class="text-gray-600 dark:text-gray-400">Buat kategori laporan baru</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                    placeholder="Contoh: Komputer dan Perangkat"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="4"
                    placeholder="Jelaskan kategori ini..."
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Simpan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>

