<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900">
        <flux:sidebar sticky stashable class="border-e border-blue-500/20 bg-gradient-to-b from-slate-900 to-slate-800 dark:border-zinc-800 dark:bg-zinc-800 shadow-lg shadow-blue-500/10">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="@auth @if(auth()->user()->isAdmin()) {{ route('admin.dashboard') }} @else {{ route('reports.my') }} @endif @else {{ route('home') }} @endauth" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/50">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent text-lg">Informatics Care</span>
            </a>

            <flux:navlist variant="outline">
                @auth
                    @if(auth()->user()->isAdmin())
                        <flux:navlist.group heading="Admin" class="grid">
                            <flux:navlist.item icon="home" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                        </flux:navlist.group>

                        <flux:navlist.group heading="Manajemen" class="grid">
                            <flux:navlist.item icon="document-duplicate" :href="route('admin.reports.index')" :current="request()->routeIs('admin.reports.*')" wire:navigate>{{ __('Laporan') }}</flux:navlist.item>
                            <flux:navlist.item icon="folder-open" :href="route('admin.categories.index')" :current="request()->routeIs('admin.categories.*')" wire:navigate>{{ __('Kategori') }}</flux:navlist.item>
                            <flux:navlist.item icon="users" :href="route('admin.users.index')" :current="request()->routeIs('admin.users.*')" wire:navigate>{{ __('Users') }}</flux:navlist.item>
                        </flux:navlist.group>
                    @else
                        <flux:navlist.group heading="Menu" class="grid">
                            <flux:navlist.item icon="document-plus" :href="route('reports.create')" :current="request()->routeIs('reports.create')" wire:navigate>{{ __('Buat Laporan') }}</flux:navlist.item>
                            <flux:navlist.item icon="document-duplicate" :href="route('reports.my')" :current="request()->routeIs('reports.my')" wire:navigate>{{ __('Laporan Saya') }}</flux:navlist.item>
                        </flux:navlist.group>
                    @endif
                @endif
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    data-test="sidebar-menu-button"
                    class="rounded-xl border border-blue-500/20 bg-gradient-to-r from-slate-800/50 to-slate-700/50 hover:from-slate-700/50 hover:to-slate-600/50 transition-all hover:border-cyan-400/30 hover:shadow-lg hover:shadow-cyan-500/10"
                />

                <flux:menu class="w-[260px] bg-gradient-to-br from-slate-900 to-slate-800 border border-blue-500/20 shadow-xl shadow-blue-500/10 rounded-xl overflow-hidden">
                    <flux:menu.radio.group>
                        <div class="p-3 bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border-b border-blue-500/20">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-cyan-400 text-white font-bold font-mono shadow-lg shadow-blue-500/50 border border-cyan-300/30">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 rounded-full border-2 border-slate-900 shadow-lg"></div>
                                </div>

                                <div class="grid flex-1 text-start leading-tight min-w-0">
                                    <span class="truncate font-semibold text-white font-mono">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-slate-400 font-mono">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-blue-500/20" />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="hover:bg-blue-500/10 hover:text-cyan-300 transition-colors font-mono text-sm">
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-blue-500/20" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full hover:bg-red-500/10 hover:text-red-300 transition-colors font-mono text-sm" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                    class="rounded-xl border border-blue-500/20 bg-gradient-to-r from-slate-800/50 to-slate-700/50 hover:from-slate-700/50 hover:to-slate-600/50 transition-all hover:border-cyan-400/30 hover:shadow-lg hover:shadow-cyan-500/10"
                />

                <flux:menu class="w-[260px] bg-gradient-to-br from-slate-900 to-slate-800 border border-blue-500/20 shadow-xl shadow-blue-500/10 rounded-xl overflow-hidden">
                    <flux:menu.radio.group>
                        <div class="p-3 bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border-b border-blue-500/20">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-cyan-400 text-white font-bold font-mono shadow-lg shadow-blue-500/50 border border-cyan-300/30">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 rounded-full border-2 border-slate-900 shadow-lg"></div>
                                </div>

                                <div class="grid flex-1 text-start leading-tight min-w-0">
                                    <span class="truncate font-semibold text-white font-mono">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-slate-400 font-mono">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-blue-500/20" />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="hover:bg-blue-500/10 hover:text-cyan-300 transition-colors font-mono text-sm">
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-blue-500/20" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full hover:bg-red-500/10 hover:text-red-300 transition-colors font-mono text-sm" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
