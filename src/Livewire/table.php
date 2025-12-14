<?php

namespace MrShaneBarron\Table\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public array $columns = [];
    public array $data = [];
    public string $sortColumn = '';
    public string $sortDirection = 'asc';
    public bool $striped = true;
    public bool $hoverable = true;
    public bool $bordered = false;
    public string $size = 'md';

    public function mount(
        array $columns = [],
        array $data = [],
        bool $striped = true,
        bool $hoverable = true,
        bool $bordered = false,
        string $size = 'md'
    ): void {
        $this->columns = $columns;
        $this->data = $data;
        $this->striped = $striped;
        $this->hoverable = $hoverable;
        $this->bordered = $bordered;
        $this->size = $size;
    }

    public function sort(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
        $this->dispatch('table-sorted', column: $column, direction: $this->sortDirection);
    }

    public function getSortedData(): array
    {
        if (empty($this->sortColumn)) {
            return $this->data;
        }
        $data = $this->data;
        usort($data, function ($a, $b) {
            $aVal = $a[$this->sortColumn] ?? '';
            $bVal = $b[$this->sortColumn] ?? '';
            $result = $aVal <=> $bVal;
            return $this->sortDirection === 'desc' ? -$result : $result;
        });
        return $data;
    }

    public function render()
    {
        return view('ld-table::livewire.table');
    }
}
