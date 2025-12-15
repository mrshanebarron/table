<?php

namespace MrShaneBarron\Table\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public array $columns = [];
    public array $data = [];
    public bool $striped = false;
    public bool $hoverable = true;
    public bool $bordered = false;
    public bool $compact = false;
    public bool $sortable = false;
    public ?string $sortBy = null;
    public string $sortDirection = 'asc';
    public bool $searchable = false;
    public string $search = '';

    public function mount(
        array $columns = [],
        array $data = [],
        bool $striped = false,
        bool $hoverable = true,
        bool $bordered = false,
        bool $compact = false,
        bool $sortable = false,
        bool $searchable = false
    ): void {
        $this->columns = $columns;
        $this->data = $data;
        $this->striped = $striped;
        $this->hoverable = $hoverable;
        $this->bordered = $bordered;
        $this->compact = $compact;
        $this->sortable = $sortable;
        $this->searchable = $searchable;
    }

    public function sortBy(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function getFilteredDataProperty(): array
    {
        $data = $this->data;

        if ($this->searchable && $this->search) {
            $search = strtolower($this->search);
            $data = array_filter($data, function ($row) use ($search) {
                foreach ($row as $value) {
                    if (str_contains(strtolower((string) $value), $search)) {
                        return true;
                    }
                }
                return false;
            });
        }

        if ($this->sortable && $this->sortBy) {
            usort($data, function ($a, $b) {
                $aVal = $a[$this->sortBy] ?? '';
                $bVal = $b[$this->sortBy] ?? '';
                $result = $aVal <=> $bVal;
                return $this->sortDirection === 'asc' ? $result : -$result;
            });
        }

        return array_values($data);
    }

    public function render()
    {
        return view('sb-table::livewire.table', [
            'filteredData' => $this->filteredData,
        ]);
    }
}
