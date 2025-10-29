@props([
    'type' => 'view', // view, edit, delete, update
    'href' => null,
    'route' => null,
    'routeParams' => [],
    'onclick' => null,
    'formAction' => null,
    'formMethod' => 'POST',
    'confirmMessage' => null,
    'class' => '',
])

@php
    $baseClasses = 'group relative px-3 py-1.5 border rounded-lg text-xs font-mono font-semibold transition-all hover:shadow-lg flex items-center gap-1.5';

    $typeClasses = [
        'view' => 'bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border-cyan-500/30 hover:border-cyan-400/50 text-cyan-400 hover:text-cyan-300 hover:shadow-cyan-500/20',
        'edit' => 'bg-gradient-to-r from-blue-500/10 to-purple-500/10 border-blue-500/30 hover:border-blue-400/50 text-blue-400 hover:text-blue-300 hover:shadow-blue-500/20',
        'delete' => 'bg-gradient-to-r from-red-500/10 to-pink-500/10 border-red-500/30 hover:border-red-400/50 text-red-400 hover:text-red-300 hover:shadow-red-500/20',
        'update' => 'bg-gradient-to-r from-blue-500/10 to-purple-500/10 border-blue-500/30 hover:border-blue-400/50 text-blue-400 hover:text-blue-300 hover:shadow-blue-500/20',
    ];

    $icons = [
        'view' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>',
        'edit' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
        'delete' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>',
        'update' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
    ];

    $labels = [
        'view' => 'View',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'update' => 'Update',
    ];

    $finalUrl = $href ?? ($route ? route($route, $routeParams) : '#');
    $buttonClass = $baseClasses . ' ' . $typeClasses[$type] . ' ' . $class;
@endphp

@if($type === 'delete' && $formAction)
    <form action="{{ $formAction }}" method="{{ $formMethod }}" class="inline" onsubmit="return confirm('{{ $confirmMessage ?? 'Yakin ingin menghapus?' }}')">
        @csrf
        @method('DELETE')
        <button type="submit" class="{{ $buttonClass }}">
            {!! $icons[$type] !!}
            {{ $labels[$type] }}
        </button>
    </form>
@elseif($onclick)
    <button onclick="{{ $onclick }}" class="{{ $buttonClass }}">
        {!! $icons[$type] !!}
        {{ $labels[$type] }}
    </button>
@else
    <a href="{{ $finalUrl }}" class="{{ $buttonClass }}">
        {!! $icons[$type] !!}
        {{ $labels[$type] }}
    </a>
@endif

