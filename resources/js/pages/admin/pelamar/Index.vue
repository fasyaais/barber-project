<script setup lang="ts">
import { columns } from '@/components/pelamar/column';
import { DataTable } from '@/components/ui/data-table';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Pelamar } from '@/types/pelamar';
import { FileText } from 'lucide-vue-next';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    pelamar: Pelamar[];
}>();
</script>

<template>
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Pelamar</h1>
            <p class="text-sm text-muted-foreground">Kelola data pelamar.</p>
        </div>

        <div v-if="props.pelamar.length" class="rounded-xl border bg-card p-4 text-card-foreground shadow-sm">
            <DataTable :columns="columns" :data="pelamar" search-key="name" search-placeholder="Cari pelamar..." />
        </div>

        <div v-else>
            <div class="rounded-xl border bg-card shadow-sm">
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <FileText class="size-6" />
                    </div>
                    <p class="font-medium">Belum ada data</p>
                    <p class="text-sm text-muted-foreground">Data pelamar akan tampil di sini.</p>
                </div>
            </div>
        </div>
    </div>
</template>