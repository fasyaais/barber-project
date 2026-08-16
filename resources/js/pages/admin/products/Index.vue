<script setup lang="ts">
import { columns } from '@/components/products/column';
import { Button } from '@/components/ui/button';
import { DataTable } from '@/components/ui/data-table';
import AdminLayout from '@/layouts/AdminLayout.vue';
import products from '@/routes/admin/products';
import { Product } from '@/types/product';
import { Link } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';

defineOptions({ layout: AdminLayout });

defineProps<{
    data: Product[];
}>();
</script>

<template>
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Produk</h1>
                <p class="text-sm text-muted-foreground">Kelola daftar produk barbershop Anda.</p>
            </div>
            <Button as-child>
                <Link :href="products.create()">
                    <Plus /> Tambah Produk
                </Link>
            </Button>
        </div>
        <div class="rounded-xl border bg-card p-4 text-card-foreground shadow-sm">
            <DataTable :columns="columns" :data="data" search-key="name" search-placeholder="Cari produk..." />
        </div>
    </div>
</template>
