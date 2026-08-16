<template>
    <div class="min-h-screen bg-white font-sans text-slate-900">
        <nav class="fixed z-50 flex w-full items-center justify-between border-b border-slate-100 bg-white/90 px-6 py-4 backdrop-blur-md md:px-12">
            <a href="/" class="flex items-center gap-2">
                <span class="text-xl font-bold tracking-tighter text-slate-800 uppercase">Tampan</span>
            </a>
            <a href="/" class="text-xs font-bold tracking-widest text-emerald-600 uppercase hover:text-emerald-700"> ← Kembali ke Beranda </a>
        </nav>

        <section class="bg-white px-6 pt-32 pb-24">
            <div class="mx-auto max-w-6xl">
                <div class="mb-16 text-center">
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Gerai Kami</h2>
                    <h1 class="font-serif text-4xl text-slate-900 italic md:text-5xl">Semua Lokasi Cabang</h1>
                    <p class="mx-auto mt-4 max-w-xl text-slate-500">Temukan gerai Tampan terdekat dari lokasi Anda dan buka di Google Maps.</p>
                </div>

                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="loc in locations"
                        :key="loc.name"
                        class="group flex flex-col overflow-hidden rounded-3xl border border-slate-100 bg-slate-50 p-2 transition hover:shadow-xl"
                    >
                        <div
                            class="relative flex h-40 w-full items-center justify-center overflow-hidden rounded-2xl bg-emerald-600 font-serif text-6xl text-white italic"
                        >
                            <img v-if="loc.image" :src="loc.image" :alt="loc.name" class="h-full w-full object-cover" />
                            <template v-else>{{ loc.name.charAt(0) }}</template>
                        </div>
                        <div class="p-6">
                            <h4 class="mb-2 text-xl font-bold text-slate-800">{{ loc.name }}</h4>
                            <p class="mb-4 text-sm leading-loose text-slate-500">{{ loc.address }}</p>
                            <a
                                :href="mapsUrl(loc)"
                                target="_blank"
                                rel="noopener"
                                class="group inline-flex items-center gap-2 text-xs font-black tracking-widest text-emerald-600 uppercase"
                            >
                                Buka di Maps
                                <span class="transition-transform group-hover:translate-x-2">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup lang="ts">
import { mapsUrl } from '@/data/locations';
import type { LocationBranch } from '@/data/locations';

defineProps<{
    locations: LocationBranch[];
}>();
</script>
