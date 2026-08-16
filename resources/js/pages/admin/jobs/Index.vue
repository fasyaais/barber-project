<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AdminLayout from '@/layouts/AdminLayout.vue';
import jobs from '@/routes/admin/jobs';
import { Job } from '@/types/job';
import { Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from 'lucide-vue-next';

defineOptions({ layout: AdminLayout });

defineProps<{ data: Array<Job> }>();

function handleDelete(id: number) {
    if (window.confirm('Hapus lowongan pekerjaan ini?')) {
        router.delete(jobs.destroy(id).url);
    }
}
</script>

<template>
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Pekerjaan</h1>
                <p class="text-sm text-muted-foreground">Kelola daftar lowongan pekerjaan.</p>
            </div>
            <Button as-child>
                <Link :href="jobs.create()">
                    <Plus /> Tambah
                </Link>
            </Button>
        </div>
        <Card>
            <CardContent class="pt-0">
                <div v-if="data && data.length > 0">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Gerai</TableHead>
                                <TableHead>Posisi</TableHead>
                                <TableHead>Deskripsi</TableHead>
                                <TableHead class="text-center">Slot</TableHead>
                                <TableHead class="text-center">Status</TableHead>
                                <TableHead>Batas Waktu</TableHead>
                                <TableHead class="text-center">Aksi</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="row in data" :key="row.id">
                                <TableCell class="font-medium">{{ row.merchant?.name }}</TableCell>
                                <TableCell>{{ row.position?.name ?? '-' }}</TableCell>
                                <TableCell class="text-muted-foreground">{{ row.description }}</TableCell>
                                <TableCell class="text-center">{{ row.slot }}</TableCell>
                                <TableCell class="text-center">
                                    <span
                                        :class="row.status === 'available' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-400' : 'bg-muted text-muted-foreground'"
                                        class="rounded-full px-2 py-1 text-xs font-medium"
                                    >
                                        {{ row.status }}
                                    </span>
                                </TableCell>
                                <TableCell>{{ row.due_date }}</TableCell>
                                <TableCell class="text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <Link :href="jobs.edit(row.id)">
                                            <Button variant="ghost" size="icon" aria-label="Edit">
                                                <Pencil class="h-4 w-4" />
                                            </Button>
                                        </Link>
                                        <Button
                                            variant="ghost"
                                            size="icon"
                                            aria-label="Hapus"
                                            @click="() => handleDelete(row.id)"
                                        >
                                            <Trash2 class="h-4 w-4 text-red-500" />
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
                <div v-else class="py-12 text-center text-muted-foreground">Tidak ada lowongan pekerjaan.</div>
            </CardContent>
        </Card>
    </div>
</template>
