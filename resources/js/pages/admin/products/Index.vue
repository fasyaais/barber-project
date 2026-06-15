<script setup lang="ts">
import { columns } from '@/components/merchants/column';
import DataTable from '@/components/merchants/data-table.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Merchant } from '@/types/merchant';
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    data : Merchant[]
}>();

const page = usePage()

onMounted(() => {
    console.log(page.url);
});

console.log(page.component.split('/'))

</script>

<template>
    <div class="container py-10 mx-auto">
        <DataTable :columns="columns" :data="props.data" />
    </div>
    <!-- <div>
        <ul>
            <li v-for="row in data" :key="row.id">{{ row.name }} kw</li>
        </ul>
    </div> -->
</template>
