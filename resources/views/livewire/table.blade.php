<div>
    @if($this->searchable)
    <div style="margin-bottom: 16px;">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Search..."
            style="width: 100%; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
        >
    </div>
    @endif

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; {{ $this->bordered ? 'border: 1px solid #e5e7eb;' : '' }}">
            <thead style="background: #f9fafb;">
                <tr>
                    @foreach($this->columns as $key => $label)
                    <th
                        style="padding: 12px 24px; text-align: left; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #6b7280; {{ $this->bordered ? 'border: 1px solid #e5e7eb;' : 'border-bottom: 1px solid #e5e7eb;' }} {{ $this->sortable ? 'cursor: pointer;' : '' }}"
                        @if($this->sortable) wire:click="sortBy('{{ $key }}')" @endif
                    >
                        <div style="display: flex; align-items: center; gap: 8px;">
                            {{ $label }}
                            @if($this->sortable && $this->sortBy === $key)
                                @if($this->sortDirection === 'asc')
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                @else
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                @endif
                            @endif
                        </div>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($this->filteredData as $rowIndex => $row)
                <tr style="{{ $this->striped && $rowIndex % 2 === 1 ? 'background: #f9fafb;' : '' }} {{ $this->hoverable ? 'transition: background 0.15s;' : '' }}" @if($this->hoverable) onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='{{ $this->striped && $rowIndex % 2 === 1 ? '#f9fafb' : 'transparent' }}'" @endif>
                    @foreach($this->columns as $key => $label)
                    <td style="padding: {{ $this->compact ? '8px 24px' : '16px 24px' }}; {{ $this->bordered ? 'border: 1px solid #e5e7eb;' : 'border-bottom: 1px solid #e5e7eb;' }}">
                        {{ $row[$key] ?? '' }}
                    </td>
                    @endforeach
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($this->columns) }}" style="padding: 16px 24px; text-align: center; color: #6b7280;">
                        No data available
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
