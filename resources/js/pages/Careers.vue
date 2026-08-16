<template>
    <Head title="Karier | Tampan Barbershop" />

    <AppLayout>
        <section class="bg-slate-50 px-6 py-16 md:py-24">
            <div class="mx-auto max-w-6xl">
                <div class="mb-16 text-center md:mb-20">
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Karier & Lowongan</h2>
                    <h3 class="font-serif text-3xl leading-tight text-slate-900 italic sm:text-4xl md:text-5xl">Mulai Karirmu Bersama Tampan</h3>
                    <p class="mx-auto mt-6 max-w-2xl leading-relaxed text-slate-500">
                        Bergabunglah dengan standar grooming tertinggi di kota. Temukan peran yang sesuai dengan bakatmu dan tumbuh bersama
                        jaringan Tampan di seluruh Indonesia.
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div
                        v-for="job in jobs"
                        :key="job.title"
                        :class="['group flex flex-col rounded-3xl border border-slate-100 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100']"
                    >
                        <div class="mb-5 flex items-center justify-between">
                            <div
                                class="flex size-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white"
                            >
                                <component :is="jobIcon(job)" class="size-6" />
                            </div>
                            <span
                                class="rounded-full px-3 py-1 text-[10px] font-black tracking-widest uppercase"
                                :class="
                                    job.type === 'Full-time'
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : job.type === 'Part-time'
                                          ? 'bg-amber-100 text-amber-700'
                                          : 'bg-sky-100 text-sky-700'
                                "
                            >
                                {{ job.type }}
                            </span>
                        </div>
                        <h4 class="text-xl font-bold text-slate-800">{{ job.title }}</h4>
                        <p class="mt-2 flex-1 leading-relaxed text-slate-500">{{ job.desc }}</p>
                        <div class="mt-5 space-y-2 border-t border-slate-100 pt-5 text-sm text-slate-500">
                            <p class="flex items-center gap-2">
                                <MapPin class="size-4 text-emerald-600" />
                                {{ job.loc }}
                            </p>
                            <p class="flex items-center gap-2">
                                <Wallet class="size-4 text-emerald-600" />
                                {{ job.salary }}
                            </p>
                        </div>
                        <Link
                            :href="`/lamar?posisi=${encodeURIComponent(job.title)}`"
                            class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-emerald-200 transition hover:bg-emerald-500"
                        >
                            Lamar Sekarang
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">
import { jobs } from '@/data/jobs';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import type { Component } from 'vue';
import { Crown, MapPin, Scissors, Sparkles, Trophy, Users, Wallet, Wrench } from 'lucide-vue-next';

function jobIcon(job: (typeof jobs)[number]): Component {
    const map: Record<string, Component> = {
        'Master Barber': Scissors,
        'Barber Stylist': Wrench,
        'Guest Relation': Crown,
        'Shop Manager': Trophy,
        'Content Creator': Sparkles,
        Receptionist: MapPin,
    };
    return map[job.title] ?? Users;
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
.font-serif {
    font-family: 'Playfair Display', serif;
}
</style>