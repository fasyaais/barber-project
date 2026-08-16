import admin from '@/routes/admin';
import products from '@/routes/admin/products';
import { Product } from '@/types/product';
import { Link, router } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import AlertError from '../alert/AlertDelete.vue';
import { Button } from '../ui/button';

export const columns: ColumnDef<Product>[] = [
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
        accessorKey: 'price',
        header: () => h('div', { class: 'text-center' }, 'Harga'),
        cell: ({ row }) => h('div', { class: 'text-center font-medium' }, row.getValue('price')),
    },
    {
        accessorKey: 'image',
        header: () => h('div', { class: 'text-center' }, 'Gambar'),
        cell: ({ row }) =>
            h('div', { class: 'flex justify-center' }, [
                h('img', {
                    src: row.getValue('image'),
                    alt: row.getValue('name'),
                    class: 'h-14 w-14 rounded-lg border object-cover',
                }),
            ]),
    },
    {
        id: 'action',
        header: () => h('div', { class: 'text-center' }, 'Aksi'),
        cell: ({ row }) => {
            const product = row.original;

            return h('div', { class: 'flex gap-2 justify-center' }, [
                h(
                    Button,
                    { asChild: true },
                    h(
                        Link,
                        {
                            href: admin.products.edit(product.id),
                        },
                        'Edit',
                    ),
                ),
                h(AlertError, {
                    onConfirm: () => {
                        router.delete(products.destroy(product.id), {
                            preserveScroll: true,
                        });
                    },
                    description: `Anda yakin untuk menghapus produk ${product.name}?`,
                }),
            ]);
        },
    },
];