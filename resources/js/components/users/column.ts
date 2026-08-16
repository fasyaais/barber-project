import { User } from '@/types/user';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';

export const columns: ColumnDef<User>[] = [
    {
        id: 'nomor',
        header: () => h('div', { class: 'text-center' }, ' '),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.index + 1),
    },
    {
        accessorKey: 'fullname',
        header: () => h('div', { class: 'text-left' }, 'Nama'),
        cell: ({ row }) => h('div', { class: 'text-left font-medium' }, row.getValue('fullname')),
    },
    {
        accessorKey: 'username',
        header: () => h('div', { class: 'text-center' }, 'Username'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('username')),
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
        accessorKey: 'role',
        header: () => h('div', { class: 'text-center' }, 'Role'),
        cell: ({ row }) => h('div', { class: 'capitalize text-center' }, row.getValue('role')),
    },
];