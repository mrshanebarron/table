<template>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th
            v-for="column in columns"
            :key="column.key"
            @click="column.sortable && sort(column.key)"
            :class="['px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider', column.sortable && 'cursor-pointer hover:bg-gray-100']"
          >
            <div class="flex items-center gap-2">
              <span>{{ column.label }}</span>
              <span v-if="column.sortable && sortKey === column.key" class="text-gray-400">
                {{ sortOrder === 'asc' ? '↑' : '↓' }}
              </span>
            </div>
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(row, rowIndex) in sortedData" :key="row.id || rowIndex" class="hover:bg-gray-50">
          <td v-for="column in columns" :key="column.key" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            <slot :name="`cell-${column.key}`" :row="row" :value="row[column.key]">
              {{ row[column.key] }}
            </slot>
          </td>
        </tr>
        <tr v-if="sortedData.length === 0">
          <td :colspan="columns.length" class="px-6 py-8 text-center text-gray-500">
            <slot name="empty">No data available</slot>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
  name: 'LdTable',
  props: {
    columns: { type: Array, default: () => [] },
    data: { type: Array, default: () => [] },
    defaultSortKey: { type: String, default: null },
    defaultSortOrder: { type: String, default: 'asc' }
  },
  emits: ['sort'],
  setup(props, { emit }) {
    const sortKey = ref(props.defaultSortKey);
    const sortOrder = ref(props.defaultSortOrder);

    const sortedData = computed(() => {
      if (!sortKey.value) return props.data;

      return [...props.data].sort((a, b) => {
        const aVal = a[sortKey.value];
        const bVal = b[sortKey.value];

        if (aVal === bVal) return 0;
        if (aVal === null || aVal === undefined) return 1;
        if (bVal === null || bVal === undefined) return -1;

        const comparison = typeof aVal === 'string'
          ? aVal.localeCompare(bVal)
          : aVal - bVal;

        return sortOrder.value === 'asc' ? comparison : -comparison;
      });
    });

    const sort = (key) => {
      if (sortKey.value === key) {
        sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
      } else {
        sortKey.value = key;
        sortOrder.value = 'asc';
      }
      emit('sort', { key: sortKey.value, order: sortOrder.value });
    };

    return { sortKey, sortOrder, sortedData, sort };
  }
};
</script>
