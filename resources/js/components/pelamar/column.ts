import { Pelamar } from '@/types/pelamar';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';

export const columns: ColumnDef<Pelamar>[] = [
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
        accessorKey: 'job.position.name',
        header: () => h('div', { class: 'text-center' }, 'Posisi'),
        cell: ({ row }) => h('div', { class: 'capitalize text-center' }, row.original.job?.position?.name ?? '-'),
    },
    {
        accessorKey: 'no_whatsapp',
        header: () => h('div', { class: 'text-center' }, 'No WhatsApp'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('no_whatsapp')),
    },
    {
        accessorKey: 'email',
        header: () => h('div', { class: 'text-center' }, 'Email'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('email')),
    },
    {
        accessorKey: 'submited_at',
        header: () => h('div', { class: 'text-center' }, 'Tanggal'),
        cell: ({ row }) => h('div', { class: 'text-center' }, new Date(row.getValue('submited_at')).toLocaleDateString('id-ID')),
    },
    {
        id: 'cv',
        header: () => h('div', { class: 'text-center' }, 'CV'),
        cell: ({ row }) => {
            const app = row.original;
            if (!app.cv) return '-';
            return h(
                'a',
                {
                    class: 'text-emerald-600 underline',
                    href: `/storage/${app.cv}`,
                    target: '_blank',
                },
                'Unduh',
            );
        },
    },
];