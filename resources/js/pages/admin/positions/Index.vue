<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { UserPlus } from 'lucide-vue-next';

defineOptions({ layout: AdminLayout });
</script>

<template>
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Posisi</h1>
            <p class="text-sm text-muted-foreground">Kelola posisi/role di gerai barbershop.</p>
        </div>
        <Card>
            <CardContent class="flex flex-col items-center justify-center py-16 text-center">
                <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <UserPlus class="size-6" />
                </div>
                <p class="font-medium">Belum ada data</p>
                <p class="text-sm text-muted-foreground">Data posisi akan tampil di sini.</p>
            </CardContent>
        </Card>
    </div>
</template>
