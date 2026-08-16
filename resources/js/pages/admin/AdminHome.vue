<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ClipboardList, Scissors, Store, UserRound, Users } from 'lucide-vue-next';
import { type Component } from 'vue';

defineOptions({ layout: AdminLayout });

interface DashboardStat {
    key: string;
    title: string;
    value: number;
    change: string;
}

interface RecentActivity {
    title: string;
    created_at: string;
}

interface LatestPelamar {
    id: number;
    name: string;
    job: string;
}

defineProps<{
    stats: DashboardStat[];
    recentActivities: RecentActivity[];
    latestPelamar?: LatestPelamar | null;
}>();

const iconFor = (key: string): Component => {
    const map: Record<string, Component> = {
        merchants: Store,
        users: Users,
        products: Scissors,
        jobs: ClipboardList,
    };

    return map[key] ?? ClipboardList;
};

function timeAgo(date: string): string {
    const diff = Date.now() - new Date(date).getTime();
    const minutes = Math.floor(diff / 60000);

    if (minutes < 1) return 'baru saja';
    if (minutes < 60) return `${minutes} menit lalu`;

    const hours = Math.floor(minutes / 60);
    if (hours < 24) return `${hours} jam lalu`;

    const days = Math.floor(hours / 24);
    if (days < 30) return `${days} hari lalu`;

    const months = Math.floor(days / 30);
    return `${months} bulan lalu`;
}
</script>

<template>
    <Head title="Dashboard" />
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
            <p class="text-sm text-muted-foreground">Ringkasan aktivitas dan data barbershop Anda.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div v-for="stat in stats" :key="stat.key" class="rounded-xl border bg-card p-5 text-card-foreground shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex size-10 items-center justify-center rounded-lg bg-primary/10 text-primary">
                        <component :is="iconFor(stat.key)" class="size-5" />
                    </div>
                    <span class="text-xs text-muted-foreground">{{ stat.change }}</span>
                </div>
                <div class="mt-4">
                    <p class="text-2xl font-bold">{{ stat.value }}</p>
                    <p class="text-sm text-muted-foreground">{{ stat.title }}</p>
                </div>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-3">
            <div class="rounded-xl border bg-card p-5 text-card-foreground shadow-sm lg:col-span-2">
                <h3 class="mb-4 font-semibold">Aktivitas Terbaru</h3>
                <div class="space-y-3 text-sm text-muted-foreground">
                    <p v-for="activity in recentActivities" :key="activity.title" class="flex justify-between border-b pb-3">
                        <span>{{ activity.title }}</span>
                        <span class="text-xs">{{ timeAgo(activity.created_at) }}</span>
                    </p>
                    <p v-if="recentActivities.length === 0">Belum ada aktivitas.</p>
                </div>
            </div>

            <div
                v-if="latestPelamar"
                class="flex flex-col rounded-xl border bg-card p-5 text-card-foreground shadow-sm"
            >
                <div class="flex items-center gap-2">
                    <div class="flex size-10 items-center justify-center rounded-lg bg-primary/10 text-primary">
                        <UserRound class="size-5" />
                    </div>
                    <h3 class="font-semibold">Pelamar Terbaru</h3>
                </div>
                <p class="mt-4 text-lg font-bold">{{ latestPelamar.name }}</p>
                <p class="text-sm text-muted-foreground">{{ latestPelamar.job }}</p>
                <Link
                    :href="`/admin/pelamar`"
                    class="mt-4 inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition hover:bg-primary/90"
                >
                    Lihat Semua Pelamar
                </Link>
            </div>

            <div
                v-else
                class="flex flex-col items-center justify-center rounded-xl border border-dashed bg-card p-5 text-card-foreground shadow-sm"
            >
                <Store class="mb-2 size-8 text-muted-foreground" />
                <p class="text-sm font-medium">Belum ada pelamar</p>
                <p class="text-center text-xs text-muted-foreground">Data pelamar akan tampil di sini.</p>
            </div>
        </div>
    </div>
</template>