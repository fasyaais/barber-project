<script setup lang="ts">
import { columns } from '@/components/users/column';
import { Button } from '@/components/ui/button';
import { DataTable } from '@/components/ui/data-table';
import AdminLayout from '@/layouts/AdminLayout.vue';
import users from '@/routes/admin/users';
import { User } from '@/types/user';
import { Link } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';

defineOptions({ layout: AdminLayout });

defineProps<{
    data: User[];
}>();
</script>

<template>
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Pengguna</h1>
                <p class="text-sm text-muted-foreground">Kelola daftar pengguna barbershop.</p>
            </div>
            <Button as-child>
                <Link :href="users.create()">
                    <Plus /> Tambah Pengguna
                </Link>
            </Button>
        </div>
        <div class="rounded-xl border bg-card p-4 text-card-foreground shadow-sm">
            <DataTable :columns="columns" :data="data" search-key="fullname" search-placeholder="Cari pengguna..." />
        </div>
    </div>
</template>