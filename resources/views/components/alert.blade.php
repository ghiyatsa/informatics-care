@props([
    'type' => 'success', // success, error, warning, info
    'message' => null,
])

@php
    $config = [
        'success' => [
            'class' => 'bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border-cyan-500/30 text-cyan-300 shadow-cyan-500/10',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
        'error' => [
            'class' => 'bg-gradient-to-r from-red-500/10 to-orange-500/10 border-red-500/30 text-red-300 shadow-red-500/10',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
        'warning' => [
            'class' => 'bg-gradient-to-r from-amber-500/10 to-yellow-500/10 border-amber-500/30 text-amber-300 shadow-amber-500/10',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
        ],
        'info' => [
            'class' => 'bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border-blue-500/30 text-blue-300 shadow-blue-500/10',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
    ];

    $configData = $config[$type] ?? $config['success'];
@endphp

@if($message || $slot->isNotEmpty())
    <div class="p-4 {{ $configData['class'] }} rounded-xl backdrop-blur-sm shadow-lg">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $configData['icon'] !!}
            </svg>
            <span>{{ $message ?? $slot }}</span>
        </div>
    </div>
@endif

