@php
use Illuminate\Support\Str;
@endphp

<x-layouts.app :title="__('Manajemen User')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <x-admin-header
            title="Manajemen User"
            subtitle="Kelola pengguna sistem"
            badge="User Management"
        >
            <x-slot name="actions">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-blue-500/30 hover:border-cyan-400/80 rounded-xl hover:bg-blue-500/10 transition-all backdrop-blur-sm text-white font-medium">← Dashboard</a>
                <a href="{{ route('admin.users.create') }}" class="group px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono flex items-center gap-2 text-white">
                    <span class="text-white">+ Add User</span>
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </x-slot>
        </x-admin-header>

        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @if($users->isEmpty())
            <x-empty-state
                title="Belum Ada User"
                description="Tambah user pertama untuk memulai"
                :actionRoute="'admin.users.create'"
                actionLabel="Tambah User"
            />
        @else
            <x-table-wrapper
                :headers="['User', 'Email', 'NIM', 'Role', 'Actions']"
                :pagination="$users->links()"
            >
                @foreach($users as $user)
                    <tr class="hover:bg-slate-800/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-cyan-500/30">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="text-sm font-semibold text-white">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-300 font-mono">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-slate-300 font-mono">{{ $user->student_id ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$user->role" type="user" />
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-action-button type="view" :href="route('admin.users.show', $user)" />
                                <x-action-button type="edit" :href="route('admin.users.edit', $user)" />
                                <x-action-button
                                    type="delete"
                                    :formAction="route('admin.users.destroy', $user)"
                                    confirmMessage="Yakin ingin menghapus user ini?"
                                />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-table-wrapper>
        @endif
    </div>
</x-layouts.app>
