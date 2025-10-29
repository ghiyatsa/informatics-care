@props([
    'status',
    'type' => 'report', // report, user
])

@php
    if ($type === 'report') {
        $statusMap = [
            'pending' => ['label' => '⏳ PENDING', 'class' => 'bg-amber-500/10 text-amber-400 border-amber-500/30'],
            'in_progress' => ['label' => '🔄 IN PROGRESS', 'class' => 'bg-blue-500/10 text-blue-400 border-blue-500/30'],
            'completed' => ['label' => '✓ COMPLETED', 'class' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30'],
            'rejected' => ['label' => '✕ REJECTED', 'class' => 'bg-red-500/10 text-red-400 border-red-500/30'],
        ];
    } else {
        $statusMap = [
            'admin' => ['label' => 'ADMIN', 'class' => 'bg-purple-500/10 text-purple-400 border-purple-500/30'],
            'user' => ['label' => 'USER', 'class' => 'bg-blue-500/10 text-blue-400 border-blue-500/30'],
        ];
    }

    // Handle enum or string
    if (is_object($status)) {
        // PHP 8.1+ BackedEnum has a 'value' property
        if ($status instanceof \BackedEnum) {
            $statusValue = $status->value;
        } elseif (property_exists($status, 'value')) {
            $statusValue = $status->value;
        } elseif (method_exists($status, 'value')) {
            $statusValue = $status->value();
        } else {
            $statusValue = (string) $status;
        }
    } else {
        $statusValue = $status;
    }

    $statusValue = strtolower((string) $statusValue);
    $statusConfig = $statusMap[$statusValue] ?? $statusMap['pending'] ?? ['label' => strtoupper($statusValue), 'class' => 'bg-slate-500/10 text-slate-400 border-slate-500/30'];
@endphp

<span class="px-3 py-1.5 rounded-lg text-xs font-mono font-medium border {{ $statusConfig['class'] }}">
    {{ $statusConfig['label'] }}
</span>
