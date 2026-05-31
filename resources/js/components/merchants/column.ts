import admin from '@/routes/admin'
import { Merchant } from '@/types/merchant'
import { Link, router } from '@inertiajs/vue3'
import { ColumnDef } from '@tanstack/vue-table'
import { h } from 'vue'
import AlertError from '../alert/AlertDelete.vue'
import merchants from '@/routes/admin/merchants'
import { Button } from '../ui/button'

export const columns: ColumnDef<Merchant>[] = [
  {
    id: 'nomor',
    header: () => ' ',
    cell: ({row}) => h('div', row.index + 1),
  },
  {
    accessorKey: 'name',
    header: () => h('div', { class: 'text-left' }, 'Name'),
    cell: ({row}) => h('div', { class: 'text-left font-medium' }, row.getValue('name') ),
  },
  {
    accessorKey: 'fullname',
    header: 'Pemilik',
    cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('fullname')),
  },
  {
    id: "action",
    header: 'Action',
    cell: ({ row }) => {
        const merchant = row.original

        return h('div', { class: 'flex gap-2' }, [
            h(
                Button,{asChild: true},h(Link,{
                    href: admin.merchants.edit(merchant.id)
                },'Edit')
            ),
            h(
                AlertError, {
                    onConfirm: () => {
                        router.delete(merchants.destroy(merchant.id),{
                            preserveScroll:true
                        })
                    },
                    description: `Anda yakin untuk menghapus gerai ${merchant.name}?`,
                }
            ),
        ])
    },

  },
]
