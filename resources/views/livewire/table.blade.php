<div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                @foreach($columns as $column)
                    <th
                        @if(isset($column['sortable']) && $column['sortable'])
                            wire:click="sort('{{ $column['key'] }}')"
                            class="cursor-pointer hover:bg-gray-100"
                        @endif
                        @class([
                            'text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                            'px-4 py-2' => $size === 'sm',
                            'px-6 py-3' => $size === 'md',
                            'px-8 py-4' => $size === 'lg',
                        ])
                    >
                        <div class="flex items-center gap-2">
                            {{ $column['label'] }}
                            @if(isset($column['sortable']) && $column['sortable'] && $sortColumn === $column['key'])
                                <svg class="w-4 h-4 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                            @endif
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($this->getSortedData() as $index => $row)
                <tr @class([
                    'bg-gray-50' => $striped && $index % 2 === 1,
                    'hover:bg-gray-100' => $hoverable,
                ])>
                    @foreach($columns as $column)
                        <td @class([
                            'text-sm text-gray-900',
                            'px-4 py-2' => $size === 'sm',
                            'px-6 py-4' => $size === 'md',
                            'px-8 py-5' => $size === 'lg',
                        ])>
                            {{ $row[$column['key']] ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="px-6 py-12 text-center text-gray-500">
                        No data available
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
