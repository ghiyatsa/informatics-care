@props([
    'title' => '',
    'subtitle' => '',
    'badge' => '',
    'actions' => null,
])

<div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-950 via-blue-900 to-cyan-900 p-8 shadow-2xl border border-blue-800/30">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnptMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAzNmMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnpNMCAwYzMuMzE0IDAgNiAyLjY4NiA2IDZzLTIuNjg2IDYtNiA2LTYtMi42ODYtNi02IDIuNjg2LTYgNi02eiIgc3Ryb2tlPSJyZ2JhKDU5LCAxMzAsIDI0NiwgMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>
    <div class="relative z-10">
        <div class="flex items-center justify-between">
            <div>
                @if($badge)
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse"></div>
                        <span class="text-cyan-400 text-sm font-mono uppercase tracking-wider">{{ $badge }}</span>
                    </div>
                @endif
                <h1 class="text-4xl font-bold text-white mb-2">
                    <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                        {{ $title }}
                    </span>
                </h1>
                @if($subtitle)
                    <p class="text-blue-200 text-lg">{{ $subtitle }}</p>
                @endif
            </div>
            @if(isset($actions))
                <div class="flex gap-3">
                    {{ $actions }}
                </div>
            @elseif($slot->isNotEmpty())
                <div class="flex gap-3">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-cyan-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-10 -top-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
</div>
