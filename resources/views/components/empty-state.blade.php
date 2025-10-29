@props([
    'title' => 'Tidak Ada Data',
    'description' => '',
    'icon' => null,
    'actionLabel' => null,
    'actionRoute' => null,
    'actionHref' => null,
])

<div class="group relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 p-12 text-center shadow-xl">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
    <div class="relative z-10">
        @if($icon)
            {!! $icon !!}
        @else
            <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-cyan-500/30 group-hover:scale-110 transition-transform">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
        @endif
        <h3 class="text-2xl font-bold text-white mb-2">{{ $title }}</h3>
        @if($description)
            <p class="text-slate-400 mb-6">{{ $description }}</p>
        @endif
        @if($actionLabel)
            @if($actionRoute)
                <a href="{{ route($actionRoute) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono text-white font-bold">
                    <span class="text-white">{{ $actionLabel }}</span>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            @elseif($actionHref)
                <a href="{{ $actionHref }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all transform hover:scale-105 font-semibold font-mono text-white font-bold">
                    <span class="text-white">{{ $actionLabel }}</span>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            @endif
        @endif
    </div>
</div>

