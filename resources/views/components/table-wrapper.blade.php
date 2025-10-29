@props([
    'headers' => [],
    'empty' => false,
    'emptyState' => null,
])

<div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl border border-blue-500/20 shadow-2xl overflow-hidden">
    @if(!$empty)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-800/50 border-b border-slate-700/50">
                    <tr>
                        @foreach($headers as $header)
                            <th class="px-6 py-4 text-left text-xs font-mono text-blue-300 uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
        @if(isset($pagination))
            <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-800/30">
                {{ $pagination }}
            </div>
        @endif
    @else
        @if($emptyState)
            <div class="p-12">
                {{ $emptyState }}
            </div>
        @else
            <div class="p-12 text-center text-slate-400">
                Tidak ada data
            </div>
        @endif
    @endif
</div>

