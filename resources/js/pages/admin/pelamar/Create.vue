<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import AdminLayout from '@/layouts/AdminLayout.vue';
import pelamar from '@/routes/admin/pelamar';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: AdminLayout });
</script>

<template>
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Tambah Pelamar</h1>
            <p class="text-sm text-muted-foreground">Buat data pelamar baru.</p>
        </div>
        <Card>
            <CardContent>
                <p class="text-sm text-muted-foreground">Formulir belum tersedia.</p>
                <div class="mt-4 flex gap-2">
                    <Button as-child>
                        <Link :href="pelamar.index()">Simpan</Link>
                    </Button>
                    <Button variant="outline" as-child>
                        <Link :href="pelamar.index()">Batal</Link>
                    </Button>
                </div>
            </CardContent>
        </Card>
    </div>
</template>
