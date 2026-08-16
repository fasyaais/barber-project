<script setup lang="ts">
import type { SidebarProps } from '@/components/ui/sidebar';
import { Link, usePage } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';
import { ClipboardList, LayoutDashboard, MapPin, Scissors, Store, UserPlus, Users, Wand2 } from 'lucide-vue-next';
import { computed } from 'vue';

import NavMain from '@/components/NavMain.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarRail,
} from '@/components/ui/sidebar';
import admin from '@/routes/admin';
import pelamar from '@/routes/admin/pelamar';
import jobs from '@/routes/admin/jobs';
import merchants from '@/routes/admin/merchants';
import positions from '@/routes/admin/positions';
import products from '@/routes/admin/products';
import services from '@/routes/admin/services';
import users from '@/routes/admin/users';

defineProps<SidebarProps>();

const page = usePage();

type NavItem = {
    title: string;
    url: string;
    icon: LucideIcon;
    items?: { title: string; url: string }[];
};

const navMain: { title: string; items: NavItem[] }[] = [
    {
        title: 'Utama',
        items: [
            {
                title: 'Dashboard',
                url: admin.dashboard().url,
                icon: LayoutDashboard,
            },
        ],
    },
    {
        title: 'Manajemen',
        items: [
            {
                title: 'Gerai',
                url: merchants.index().url,
                icon: Store,
                items: [
                    { title: 'Daftar Gerai', url: merchants.index().url },
                    { title: 'Tambah Gerai', url: merchants.create().url },
                ],
            },
            {
                title: 'Pengguna',
                url: users.index().url,
                icon: Users,
                items: [
                    { title: 'Daftar Pengguna', url: users.index().url },
                    { title: 'Tambah Pengguna', url: users.create().url },
                ],
            },
        ],
    },
    {
        title: 'Konten',
        items: [
            {
                title: 'Produk',
                url: products.index().url,
                icon: Scissors,
            },
            {
                title: 'Pekerjaan',
                url: jobs.index().url,
                icon: ClipboardList,
            },
            {
                title: 'Posisi',
                url: positions.index().url,
                icon: UserPlus,
            },
            {
                title: 'Pelamar',
                url: pelamar.index().url,
                icon: MapPin,
            },
            {
                title: 'Layanan',
                url: services.index().url,
                icon: Wand2,
            },
        ],
    },
];

const isItemActive = (item: NavItem): boolean => {
    if (item.title === 'Dashboard') return page.url === item.url;
    return page.url.startsWith(item.url);
};

const currentTitle = computed(() => {
    for (const group of navMain) {
        for (const item of group.items) {
            if (isItemActive(item)) return item.title;
        }
    }
    return 'Dashboard';
});
</script>

<template>
    <Sidebar>
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="admin.dashboard()">
                            <div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-primary text-primary-foreground">
                                <Scissors class="size-4" />
                            </div>
                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">Tampan</span>
                                <span class="truncate text-xs">Admin Panel</span>
                            </div>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>
        <SidebarContent>
            <SidebarGroup v-for="group in navMain" :key="group.title">
                <SidebarGroupLabel>{{ group.title }}</SidebarGroupLabel>
                <SidebarGroupContent>
                    <SidebarMenu>
                        <template v-for="item in group.items" :key="item.title">
                            <SidebarMenuItem v-if="!item.items">
                                <SidebarMenuButton as-child :is-active="isItemActive(item)">
                                    <Link :href="item.url">
                                        <component :is="item.icon" v-if="item.icon" />
                                        <span>{{ item.title }}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                            <NavMain v-else :items="[item]" />
                        </template>
                    </SidebarMenu>
                </SidebarGroupContent>
            </SidebarGroup>
        </SidebarContent>
        <SidebarFooter>
            <div class="flex items-center gap-2 rounded-md border p-2 text-sm">
                <div class="flex aspect-square size-8 items-center justify-center rounded-full bg-primary/10 font-semibold text-primary">
                    {{ currentTitle.charAt(0) }}
                </div>
                <div class="grid flex-1 leading-tight">
                    <span class="truncate font-medium">Admin</span>
                    <span class="truncate text-xs text-muted-foreground">barbershop</span>
                </div>
            </div>
        </SidebarFooter>
        <SidebarRail />
    </Sidebar>
</template>
