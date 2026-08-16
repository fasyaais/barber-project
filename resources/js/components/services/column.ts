import admin from '@/routes/admin';
import services from '@/routes/admin/services';
import { Service } from '@/types/service';
import { Link, router } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import AlertError from '../alert/AlertDelete.vue';
import { Button } from '../ui/button';

export const columns: ColumnDef<Service>[] = [
    {
        id: 'nomor',
        header: () => h('div', { class: 'text-center' }, ' '),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.index + 1),
    },
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left' }, 'Nama'),
        cell: ({ row }) => h('div', { class: 'text-left font-medium' }, row.getValue('name')),
    },
    {
        accessorKey: 'description',
        header: () => h('div', { class: 'text-left' }, 'Deskripsi'),
        cell: ({ row }) => h('div', { class: 'text-left text-muted-foreground' }, row.getValue('description')),
    },
    {
        accessorKey: 'img',
        header: () => h('div', { class: 'text-center' }, 'Gambar'),
        cell: ({ row }) => {
            const img = row.getValue('img') as string | null;
            return h('div', { class: 'flex justify-center' }, [
                img
                    ? h('img', {
                          src: img,
                          alt: row.getValue('name'),
                          class: 'h-14 w-14 rounded-lg border object-cover',
                      })
                    : h('div', { class: 'text-center text-muted-foreground' }, '-'),
            ]);
        },
    },
    {
        id: 'action',
        header: () => h('div', { class: 'text-center' }, 'Aksi'),
        cell: ({ row }) => {
            const service = row.original;

            return h('div', { class: 'flex gap-2 justify-center' }, [
                h(
                    Button,
                    { asChild: true },
                    h(
                        Link,
                        {
                            href: admin.services.edit(service.id),
                        },
                        'Edit',
                    ),
                ),
                h(AlertError, {
                    onConfirm: () => {
                        router.delete(services.destroy(service.id), {
                            preserveScroll: true,
                        });
                    },
                    description: `Anda yakin untuk menghapus layanan ${service.name}?`,
                }),
            ]);
        },
    },
];