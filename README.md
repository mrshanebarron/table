# Table

Data tables with sorting, searching, and styling options for Laravel applications. Supports striped rows, hover effects, borders, and compact mode. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/table
```

## Livewire Usage

### Basic Usage

```blade
@php
$columns = [
    'name' => 'Name',
    'email' => 'Email',
    'status' => 'Status',
];

$data = [
    ['name' => 'John Doe', 'email' => 'john@example.com', 'status' => 'Active'],
    ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'status' => 'Pending'],
];
@endphp

<livewire:sb-table :columns="$columns" :data="$data" />
```

### With Sorting

```blade
<livewire:sb-table
    :columns="$columns"
    :data="$data"
    :sortable="true"
/>
```

### With Search

```blade
<livewire:sb-table
    :columns="$columns"
    :data="$data"
    :searchable="true"
/>
```

### Full Featured

```blade
<livewire:sb-table
    :columns="$columns"
    :data="$data"
    :striped="true"
    :hoverable="true"
    :bordered="true"
    :sortable="true"
    :searchable="true"
/>
```

### Compact Mode

```blade
<livewire:sb-table :columns="$columns" :data="$data" :compact="true" />
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `columns` | array | `[]` | Column definitions (key => label) |
| `data` | array | `[]` | Row data array |
| `striped` | boolean | `false` | Alternate row colors |
| `hoverable` | boolean | `true` | Highlight rows on hover |
| `bordered` | boolean | `false` | Add cell borders |
| `compact` | boolean | `false` | Reduce cell padding |
| `sortable` | boolean | `false` | Enable column sorting |
| `searchable` | boolean | `false` | Show search input |

## Vue 3 Usage

### Setup

```javascript
import { SbTable } from './vendor/sb-table';
app.component('SbTable', SbTable);
```

### Basic Usage

```vue
<template>
  <SbTable :columns="columns" :data="data" />
</template>

<script setup>
const columns = {
  name: 'Name',
  email: 'Email',
  status: 'Status',
};

const data = [
  { name: 'John Doe', email: 'john@example.com', status: 'Active' },
  { name: 'Jane Smith', email: 'jane@example.com', status: 'Pending' },
];
</script>
```

### With All Options

```vue
<template>
  <SbTable
    :columns="columns"
    :data="data"
    :striped="true"
    :hoverable="true"
    :bordered="true"
    :sortable="true"
    :searchable="true"
  />
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `columns` | Object | `{}` | Column definitions |
| `data` | Array | `[]` | Table data |
| `striped` | Boolean | `false` | Striped rows |
| `hoverable` | Boolean | `true` | Hover effect |
| `bordered` | Boolean | `false` | Cell borders |
| `compact` | Boolean | `false` | Compact mode |
| `sortable` | Boolean | `false` | Enable sorting |
| `searchable` | Boolean | `false` | Enable search |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `sort` | { column, direction } | Emitted when sort changes |
| `search` | string | Emitted when search query changes |

## Dynamic Data Loading

```php
// In your Livewire component
public function mount()
{
    $this->columns = [
        'name' => 'Name',
        'email' => 'Email',
        'created_at' => 'Joined',
    ];

    $this->data = User::all()->map(fn($user) => [
        'name' => $user->name,
        'email' => $user->email,
        'created_at' => $user->created_at->format('M d, Y'),
    ])->toArray();
}
```

## Styling

The table includes:
- Clean, minimal design
- Sort indicators on column headers
- Search input with icon
- Responsive horizontal scrolling

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
