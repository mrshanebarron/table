<div>
    @if($searchable)
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search" 
            placeholder="Search..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="{{ config('sb-table.classes.table') }} @if($bordered) {{ config('sb-table.classes.bordered') }} @endif">
            <thead class="{{ config('sb-table.classes.thead') }}">
                <tr>
                    @foreach($columns as $key => $label)
                    <th 
                        class="{{ config('sb-table.classes.th') }} @if($sortable) cursor-pointer hover:bg-gray-100 @endif"
                        @if($sortable) wire:click="sortBy('{{ $key }}')" @endif
                    >
                        <div class="flex items-center gap-2">
                            {{ $label }}
                            @if($sortable && $sortBy === $key)
                                @if($sortDirection === 'asc')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                @endif
                            @endif
                        </div>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="{{ config('sb-table.classes.tbody') }}">
                @forelse($filteredData as $row)
                <tr class="@if($striped) {{ config('sb-table.classes.striped') }} @endif @if($hoverable) {{ config('sb-table.classes.hoverable') }} @endif">
                    @foreach($columns as $key => $label)
                    <td class="{{ config('sb-table.classes.td') }} @if($compact) {{ config('sb-table.classes.compact') }} @endif">
                        {{ $row[$key] ?? '' }}
                    </td>
                    @endforeach
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center text-gray-500">
                        No data available
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
