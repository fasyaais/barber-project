<template>
    <Head title="Tampan Barbershop" />

    <AppLayout>
        <!-- ===== HERO ===== -->
        <section class="relative flex min-h-screen w-full items-center justify-center overflow-hidden bg-emerald-950">
            <div class="absolute inset-0 z-0">
                <img
                    src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?q=80&w=2074"
                    class="h-full w-full object-cover"
                    alt="Barbershop interior"
                />
            </div>
            <div class="absolute inset-0 z-0 bg-gradient-to-b from-emerald-950/70 via-emerald-950/60 to-emerald-950"></div>

            <div class="relative z-10 mx-auto max-w-5xl px-6 py-32 text-center md:py-40" v-reveal>
                <span class="mb-6 inline-block text-xs font-black tracking-[0.4em] text-emerald-300 uppercase"> The Gentleman's Sanctuary </span>
                <h1 class="font-serif text-3xl sm:text-4xl leading-tight text-white sm:text-5xl md:text-7xl">
                    Rapi Itu Karakter. <br />
                    <span class="text-emerald-300 italic">Potong Itu Seni.</span>
                </h1>
                <p class="mx-auto mt-8 max-w-2xl text-lg leading-relaxed font-light text-emerald-50/90">
                    Tampan Barbershop menghadirkan pengalaman grooming premium — presisi, elegan, dan modern untuk penampilan terbaik Anda.
                </p>
                <div class="mt-12 flex flex-col justify-center gap-4 sm:flex-row">
                    <a
                        href="#layanan"
                        class="rounded-full bg-emerald-500 px-10 py-4 text-sm font-bold text-white shadow-xl shadow-emerald-500/30 transition hover:bg-emerald-400"
                    >
                        Lihat Layanan
                    </a>
                    <a
                        href="#lokasi"
                        class="rounded-full border border-emerald-200/40 bg-white/10 px-10 py-4 text-sm font-bold text-white backdrop-blur-sm transition hover:bg-white/20"
                    >
                        Temukan Lokasi
                    </a>
                </div>

                <div class="mx-auto mt-20 grid max-w-2xl grid-cols-2 gap-6 border-t border-emerald-200/20 pt-8 sm:grid-cols-4 md:gap-6">
                    <div v-for="stat in stats" :key="stat.label" class="text-center" v-reveal>
                        <p class="text-2xl font-bold text-white sm:text-3xl md:text-4xl">{{ stat.value }}</p>
                        <p class="mt-1 text-xs tracking-widest text-emerald-200 uppercase">{{ stat.label }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== ABOUT ===== -->
        <section class="bg-white px-6 py-16 md:py-24">
            <div class="mx-auto grid max-w-6xl items-center gap-12 md:grid-cols-2">
                <div v-reveal class="relative">
                    <div class="aspect-[4/5] w-full overflow-hidden rounded-3xl">
                        <img
                            src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=1200"
                            class="h-full w-full object-cover"
                            alt="Barber working"
                        />
                    </div>
                    <div class="absolute -right-6 -bottom-6 hidden rounded-2xl bg-emerald-600 p-6 text-white shadow-2xl md:block">
                        <p class="text-3xl font-bold">10+</p>
                        <p class="text-xs tracking-widest text-emerald-100 uppercase">Tahun Pengalaman</p>
                    </div>
                </div>
                <div v-reveal>
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Tentang Kami</h2>
                    <h3 class="font-serif text-3xl sm:text-4xl leading-tight text-slate-900 italic">Standar Grooming Tertinggi di Kota</h3>
                    <p class="mt-6 leading-relaxed text-slate-500">
                        Kami percaya kerapian adalah bentuk kesopanan tertinggi. Setiap kunjungan adalah pengalaman — dari konsultasi gaya hingga
                        detail akhir, tim barber profesional kami memastikan Anda pulang dengan percaya diri.
                    </p>
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div v-for="feat in values" :key="feat" class="flex items-center gap-3 text-slate-700">
                            <span class="flex size-8 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">✓</span>
                            <span class="text-sm font-medium">{{ feat }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== FOUNDER ===== -->
        <section class="bg-slate-50 px-6 py-16 md:py-24">
            <div class="mx-auto grid max-w-6xl items-center gap-12 md:grid-cols-2">
                <div v-reveal class="relative">
                    <div class="aspect-[4/5] w-full overflow-hidden rounded-3xl">
                        <img :src="founder.image" :alt="founder.name" class="h-full w-full object-cover" />
                    </div>
                    <div class="absolute -right-6 -bottom-6 hidden rounded-2xl bg-emerald-600 p-6 text-white shadow-2xl md:block">
                        <p class="text-xl font-bold">{{ founder.name }}</p>
                        <p class="text-xs tracking-widest text-emerald-100 uppercase">{{ founder.title }}</p>
                    </div>
                </div>
                <div v-reveal>
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Sang Pendiri</h2>
                    <h3 class="font-serif text-3xl sm:text-4xl leading-tight text-slate-900 italic">Prestasi & Dedikasi Menuju Puncak</h3>
                    <p class="mt-6 border-l-4 border-emerald-200 pl-4 text-slate-600 italic">"{ founder.quote }"</p>

                    <div class="mt-8 space-y-4">
                        <div
                            v-for="(achievement, index) in founderAchievements"
                            :key="achievement.title"
                            :v-reveal="index * 100"
                            class="flex items-start gap-4 rounded-2xl border border-slate-100 bg-white p-5 transition hover:shadow-lg"
                        >
                            <div class="flex size-11 flex-shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <component :is="achievement.icon" class="size-5" />
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">{{ achievement.title }}</h4>
                                <p class="mt-0.5 text-sm text-slate-500">{{ achievement.desc }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SERVICES ===== -->
        <section id="layanan" class="bg-white px-6 py-16 md:py-24">
            <div class="mx-auto max-w-6xl">
                <div v-reveal class="mb-16 text-center md:text-left">
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Layanan Eksklusif</h2>
                    <h3 class="font-serif text-3xl sm:text-4xl text-slate-900 italic md:text-5xl">Menu Perawatan Kami</h3>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <div
                        v-for="(service, index) in services"
                        :key="service.name"
                        :v-reveal="index * 100"
                        class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-8 shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-emerald-100"
                    >
                        <div
                            class="mb-5 flex size-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white"
                        >
                            <component :is="service.icon" class="size-6" />
                        </div>
                        <div class="mb-4">
                            <h4 class="text-xl font-bold text-slate-800">{{ service.name }}</h4>
                        </div>
                        <p class="leading-relaxed text-slate-500">{{ service.desc }}</p>
                        <div class="mt-6 h-1 w-10 bg-emerald-200 transition-all duration-500 group-hover:w-full group-hover:bg-emerald-600"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== PRODUCTS ===== -->
        <section id="produk" class="bg-white px-6 py-16 md:py-24">
            <div class="mx-auto max-w-6xl">
                <div v-reveal class="mb-16 text-center md:text-left">
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Produk Kami</h2>
                    <h3 class="font-serif text-3xl sm:text-4xl text-slate-900 italic md:text-5xl">Perlengkapan Grooming Premium</h3>
                </div>

                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div
                        v-for="(product, index) in products"
                        :key="product.name"
                        :v-reveal="index * 100"
                        class="group overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-emerald-100"
                    >
                        <div class="aspect-square w-full overflow-hidden">
                            <img
                                :src="product.image"
                                :alt="product.name"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />
                        </div>
                        <div class="p-6">
                            <div class="mb-2 flex items-center justify-between">
                                <h4 class="text-lg font-bold text-slate-800">{{ product.name }}</h4>
                                <span class="text-base font-bold text-emerald-600">{{ product.price }}</span>
                            </div>
                            <p class="text-sm leading-relaxed text-slate-500">{{ product.desc }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== PARTNERSHIP ===== -->
        <section id="mitra" class="bg-emerald-950 px-6 py-16 md:py-24">
            <div class="mx-auto grid max-w-6xl items-center gap-12 md:grid-cols-2">
                <div v-reveal>
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-300 uppercase">Jadi Mitra</h2>
                    <h3 class="font-serif text-3xl sm:text-4xl leading-tight text-white italic">Tumbuhkan Barbershop Anda Bersama Kami</h3>
                    <p class="mt-6 leading-relaxed text-emerald-100/80">
                        Bergabunglah sebagai mitra Tampan dan bangun bisnis grooming yang profesional dengan dukungan penuh dari jaringan kami.
                    </p>
                    <a
                        href="#karir"
                        class="mt-8 inline-block rounded-full bg-emerald-500 px-8 py-3.5 text-sm font-bold text-white shadow-xl shadow-emerald-500/30 transition hover:bg-emerald-400"
                    >
                        Pelajari Kemitraan
                    </a>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div
                        v-for="(benefit, index) in partnershipBenefits"
                        :key="benefit.title"
                        :v-reveal="index * 100"
                        class="rounded-3xl border border-emerald-200/10 bg-white/5 p-6 backdrop-blur-sm transition hover:bg-white/10"
                    >
                        <div class="mb-4 flex size-12 items-center justify-center rounded-2xl bg-emerald-500/20 text-emerald-300">
                            <component :is="benefit.icon" class="size-6" />
                        </div>
                        <h4 class="mb-2 text-lg font-bold text-white">{{ benefit.title }}</h4>
                        <p class="text-sm leading-relaxed text-emerald-100/70">{{ benefit.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== LOCATIONS ===== -->
        <section id="lokasi" class="bg-white px-6 py-16 md:py-24">
            <div class="mx-auto max-w-6xl">
                <div v-reveal class="mb-16 text-center">
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Gerai Kami</h2>
                    <h3 class="font-serif text-3xl sm:text-4xl text-slate-900 italic md:text-5xl">Temukan Lokasi Terdekat</h3>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <div
                        v-for="(loc, index) in featuredLocations"
                        :key="loc.name"
                        :v-reveal="index * 100"
                        class="group flex flex-col gap-8 overflow-hidden rounded-3xl border border-slate-100 bg-slate-50 p-2 transition hover:shadow-xl md:flex-row"
                    >
                        <div
                            class="relative flex h-48 w-full flex-shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-emerald-600 font-serif text-6xl text-white italic md:w-48"
                        >
                            <img v-if="loc.image" :src="loc.image" :alt="loc.name" class="h-full w-full object-cover" />
                            <template v-else>{{ loc.name.charAt(0) }}</template>
                        </div>
                        <div class="p-6 md:p-4">
                            <h4 class="mb-3 text-2xl font-bold text-slate-800">{{ loc.name }}</h4>
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

                <div v-reveal class="mt-14 text-center">
                    <a
                        href="/locations"
                        class="inline-block rounded-full border border-emerald-600 px-10 py-3.5 text-sm font-bold text-emerald-600 transition hover:bg-emerald-600 hover:text-white"
                    >
                        Lihat Semua Lokasi
                    </a>
                </div>
            </div>
        </section>

        <!-- ===== CAREERS ===== -->
        <section id="karir" class="bg-slate-50 px-6 py-16 md:py-24">
            <div class="mx-auto grid max-w-6xl items-center gap-12 lg:grid-cols-2">
                <div v-reveal>
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Karier & Lowongan</h2>
                    <h3 class="font-serif text-3xl leading-tight text-slate-900 italic sm:text-4xl">Mulai Karirmu Bersama Tampan</h3>
                    <p class="mt-6 leading-relaxed text-slate-500">
                        Bergabunglah dengan standar grooming tertinggi di kota. Kami mencari talenta yang berdedikasi, ramah, dan mencintai
                        seni kerapian untuk berkembang bersama jaringan kami.
                    </p>
                    <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                        <a
                            href="/lamar"
                            class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-8 py-3.5 text-sm font-bold text-white shadow-xl shadow-emerald-500/30 transition hover:bg-emerald-500"
                        >
                            Lamar Lamaran
                        </a>
                        <a
                            href="/karir"
                            class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-8 py-3.5 text-sm font-bold text-slate-700 transition hover:border-emerald-600 hover:text-emerald-600"
                        >
                            Lihat Semua Lowongan
                        </a>
                    </div>
                </div>

                <div class="space-y-4">
                    <div
                        v-for="(job, index) in featuredJobs"
                        :key="job.title"
                        :v-reveal="index * 100"
                        class="group flex flex-col gap-4 rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div class="flex flex-1 items-start gap-4">
                            <div
                                class="flex size-12 flex-shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white"
                            >
                                <component :is="jobIcon(job)" class="size-6" />
                            </div>
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h4 class="text-lg font-bold text-slate-800">{{ job.title }}</h4>
                                    <span
                                        class="rounded-full px-2.5 py-0.5 text-[10px] font-black tracking-widest uppercase"
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
                                <p class="mt-1 text-sm leading-relaxed text-slate-500">{{ job.desc }}</p>
                                <p class="mt-2 text-xs font-semibold tracking-wide text-slate-400 uppercase">
                                    {{ job.loc }} &bull; {{ job.salary }}
                                </p>
                            </div>
                        </div>
                        <a
                            :href="`/lamar?posisi=${encodeURIComponent(job.title)}`"
                            class="flex-shrink-0 rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white shadow-md transition hover:bg-emerald-500"
                        >
                            Apply
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">
import { mapsUrl } from '@/data/locations';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useIntersectionObserver } from '@vueuse/core';
import type { Component } from 'vue';
import { Award, Crown, Handshake, Headset, LineChart, Medal, Scissors, Sparkles, Trophy, Users, Wrench } from 'lucide-vue-next';

interface HomeProduct {
    name: string;
    price: string | null;
    desc: string;
    image: string;
}

interface HomeJob {
    title: string;
    type: string | null;
    loc: string | null;
    salary: string | null;
    desc: string;
}

interface HomeLocation {
    name: string;
    address: string;
    image?: string | null;
    link?: string | null;
}

interface HomeService {
    name: string;
    desc: string;
    image?: string | null;
}

interface HomeStat {
    value: string | number;
    label: string;
}

const props = defineProps<{
    products?: HomeProduct[];
    jobs?: HomeJob[];
    locations?: HomeLocation[];
    services?: HomeService[];
    stats?: HomeStat[];
}>();

const services = (props.services ?? []).map((svc) => ({
    name: svc.name,
    desc: svc.desc,
    icon: componentForService(svc.name),
}));

const stats = props.stats ?? [];

const partnershipBenefits = [
    { title: 'Support Penuh', desc: 'Tim kami mendampingi dari grand opening hingga operasional harian.', icon: Handshake },
    { title: 'Pelatihan Barber', desc: 'Program pelatihan berkelanjutan untuk meningkatkan skill tim Anda.', icon: Crown },
    { title: 'Manajemen Terpadu', desc: 'Sistem digital untuk pencatatan, produk, dan kepegawaian dalam satu platform.', icon: Headset },
    { title: 'Keuntungan Transparan', desc: 'Sistem pembagian hasil yang jelas, adil, dan dapat dipantau kapan saja.', icon: LineChart },
];

const values = ['Barber Profesional', 'Produk Premium', 'Harga Terjangkau', 'Lingkungan Nyaman'];

const founder = {
    name: 'Founder Tampan',
    title: 'Founder & Head Barber',
    image: 'https://images.unsplash.com/photo-1507101105822-7472b28e22ac?q=80&w=1200',
    quote: 'Setiap potongan adalah dedikasi terhadap kerapian dan kepercayaan diri.',
};

const founderAchievements = [
    { title: 'Juara Barber Nasional 2023', desc: 'Juara pertama kompetisi barber tingkat nasional.', icon: Trophy },
    { title: '10+ Tahun Pengalaman', desc: 'Puluhan ribu pelanggan telah dilayani dengan standar premium.', icon: Medal },
    { title: 'Asian Grooming Awards', desc: 'Diakui sebagai salah satu grooming studio terbaik di Asia.', icon: Award },
    { title: 'Mentor 100+ Barber', desc: 'Melatih dan mencetak lebih dari 100 barber profesional.', icon: Users },
];

const products = props.products ?? [];
const allJobs = props.jobs ?? [];
const featuredJobs = allJobs.slice(0, 3);

function jobIcon(job: HomeJob): Component {
    return componentForTitle(job.title);
}

function componentForService(name: string): Component {
    const map: Record<string, Component> = {
        'Classic Cut': Scissors,
        'Royal Shave': Sparkles,
        'Gentle Care': Crown,
        'Beard Trim': Wrench,
        'Anti-Bacterial Wash': Sparkles,
        'Face Treatment': Crown,
    };
    return map[name] ?? Scissors;
}

function componentForTitle(title: string): Component {
    const map: Record<string, Component> = {
        'Master Barber': Scissors,
        'Barber Stylist': Wrench,
        'Guest Relation': Headset,
        'Shop Manager': Trophy,
        'Content Creator': Sparkles,
        Receptionist: Crown,
    };
    return map[title] ?? Users;
}

const featuredLocations = props.locations?.slice(0, 3) ?? [];

// Scroll-reveal directive: fades content up as it enters the viewport.
const vReveal = {
    mounted(el: HTMLElement, binding: { value?: number }) {
        el.setAttribute('data-reveal', '');
        el.style.opacity = '0';
        el.style.transform = 'translateY(24px)';
        el.style.transition = 'opacity 0.7s ease, transform 0.7s ease';
        if (typeof binding.value === 'number') {
            el.style.transitionDelay = `${binding.value}ms`;
        }
        const { stop } = useIntersectionObserver(el, ([entry]) => {
            if (entry.isIntersecting) {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
                stop();
            }
        });
    },
};
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
.font-serif {
    font-family: 'Playfair Display', serif;
}

@media (prefers-reduced-motion: reduce) {
    [data-reveal] {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
    }
}
</style>
