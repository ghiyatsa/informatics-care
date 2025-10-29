@php
use Illuminate\Support\Str;
@endphp
<x-layouts.app :title="__('Detail User')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail User</h1>
                <p class="text-gray-600 dark:text-gray-400">Informasi lengkap user</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Kembali
                </a>
                <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Edit
                </a>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- User Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi User</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">NIM / Student ID</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $user->student_id ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Role</dt>
                        <dd class="mt-1">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                @if($user->role === 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400
                                @else bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Verified</dt>
                        <dd class="mt-1">
                            @if($user->email_verified_at)
                                <span class="text-green-600">✓ Verified</span>
                            @else
                                <span class="text-red-600">✗ Not Verified</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Joined</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $user->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Statistik</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Laporan</dt>
                        <dd class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $user->reports_count }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Recent Reports -->
            <div class="col-span-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Laporan Terbaru</h3>
                @if($reports->isEmpty())
                    <p class="text-gray-500">User ini belum membuat laporan</p>
                @else
                    <div class="space-y-3">
                        @foreach($reports as $report)
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $report->title }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $report->category->name }} • {{ $report->location }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>

