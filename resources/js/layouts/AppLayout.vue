<template>
    <div class="min-h-screen bg-white font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900">
        <nav
            :class="[
                'fixed z-50 flex w-full items-center justify-between px-6 py-4 transition-all duration-300 md:px-12',
                isScrolled ? 'border-b border-emerald-50 bg-white/80 py-3 shadow-sm backdrop-blur-md' : 'bg-transparent',
            ]"
        >
            <div class="group flex cursor-pointer items-center gap-2">
                <div class="rounded border-2 border-emerald-600 p-1 text-emerald-600 transition-transform group-hover:rotate-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758L5 19m0-14l4.121 4.121"
                        />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tighter text-slate-800 uppercase">Tampan</span>
            </div>

            <div class="hidden gap-8 text-xs font-bold tracking-widest uppercase md:flex">
                <a
                    v-for="link in navLinks"
                    :key="link.path"
                    :href="link.path"
                    :class="isActive(link.path) ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600'"
                    class="transition"
                    @click.prevent="go(link)"
                >
                    {{ link.label }}
                </a>
            </div>

            <div class="flex items-center gap-2">
                <div class="hidden md:flex">
                    <button
                        class="rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-emerald-200 transition hover:bg-emerald-700"
                    >
                        Pesan Sekarang
                    </button>
                </div>

                <button
                    class="flex size-11 items-center justify-center rounded-full border border-slate-200 text-slate-700 transition hover:bg-slate-100 md:hidden"
                    aria-label="Menu"
                    :aria-expanded="isOpen"
                    @click="isOpen = !isOpen"
                >
                    <svg v-if="isOpen" xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile drawer -->
        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="-translate-y-2 opacity-0"
            enter-to-class="translate-y-0 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100"
            leave-to-class="-translate-y-2 opacity-0"
        >
            <div v-if="isOpen" class="fixed inset-x-0 top-16 z-40 md:hidden">
                <div class="mx-4 overflow-hidden rounded-2xl border border-slate-100 bg-white/95 shadow-xl backdrop-blur-md">
                    <nav class="flex flex-col">
                        <a
                            v-for="link in navLinks"
                            :key="link.path"
                            :href="link.path"
                            :class="isActive(link.path) ? 'text-emerald-600' : 'text-slate-700 hover:text-emerald-600'"
                            class="px-6 py-4 text-sm font-bold tracking-widest uppercase transition hover:bg-emerald-50"
                            @click.prevent="go(link)"
                        >
                            {{ link.label }}
                        </a>
                        <div class="border-t border-slate-100 p-4">
                            <button
                                class="w-full rounded-full bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-emerald-200 transition hover:bg-emerald-700"
                            >
                                Pesan Sekarang
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
        </Transition>

        <!-- Backdrop -->
        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="isOpen" class="fixed inset-0 z-30 bg-slate-950/40 backdrop-blur-sm md:hidden" @click="isOpen = false"></div>
        </Transition>

        <main>
            <slot />
        </main>

        <footer class="bg-emerald-950 py-16 text-emerald-100/70">
            <div class="mx-auto max-w-6xl px-6">
                <div class="grid gap-10 md:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <div class="rounded border-2 border-emerald-500 p-1 text-emerald-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758L5 19m0-14l4.121 4.121"
                                    />
                                </svg>
                            </div>
                            <span class="text-xl font-bold tracking-tighter text-white uppercase">Tampan</span>
                        </div>
                        <p class="mt-4 max-w-xs text-sm leading-relaxed">
                            Barbershop premium dengan standar grooming tertinggi. Elegance in Every Cut.
                        </p>
                    </div>

                    <div>
                        <h4 class="mb-4 text-sm font-black tracking-widest text-white uppercase">Navigasi</h4>
                        <ul class="space-y-3 text-sm">
                            <li>
                                <a href="/#layanan" class="transition hover:text-emerald-300">Layanan</a>
                            </li>
                            <li>
                                <a href="/locations" class="transition hover:text-emerald-300">Lokasi</a>
                            </li>
                            <li>
                                <a href="/karir" class="transition hover:text-emerald-300">Karir</a>
                            </li>
                            <li>
                                <a href="/lamar" class="transition hover:text-emerald-300">Lamar</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-4 text-sm font-black tracking-widest text-white uppercase">Kontak</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-2">
                                <MapPin class="mt-0.5 size-4 flex-shrink-0 text-emerald-400" />
                                <span>Jl. Senopati Raya 12, Jakarta Selatan</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <Phone class="size-4 flex-shrink-0 text-emerald-400" />
                                <span>0895-3322-8255</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <Mail class="size-4 flex-shrink-0 text-emerald-400" />
                                <span>hello@tampanbarbershop.com</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-4 text-sm font-black tracking-widest text-white uppercase">Jam Operasional</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center justify-between">
                                <span>Senin – Jumat</span>
                                <span class="text-emerald-300">09.00 – 21.00</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Sabtu</span>
                                <span class="text-emerald-300">08.00 – 22.00</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Minggu</span>
                                <span class="text-emerald-300">09.00 – 20.00</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-emerald-800 pt-8 md:flex-row">
                    <p class="text-xs">© {{ new Date().getFullYear() }} Tampan Barbershop. Elegance in Every Cut.</p>
                    <div class="flex items-center gap-3">
                        <a href="#" aria-label="Instagram" class="flex size-9 items-center justify-center rounded-full border border-emerald-800 transition hover:border-emerald-400 hover:text-emerald-300">
                            <Instagram class="size-4" />
                        </a>
                        <a href="#" aria-label="Facebook" class="flex size-9 items-center justify-center rounded-full border border-emerald-800 transition hover:border-emerald-400 hover:text-emerald-300">
                            <Facebook class="size-4" />
                        </a>
                        <a href="#" aria-label="TikTok" class="flex size-9 items-center justify-center rounded-full border border-emerald-800 transition hover:border-emerald-400 hover:text-emerald-300">
                            <Music2 class="size-4" />
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { Facebook, Instagram, Mail, MapPin, Music2, Phone } from 'lucide-vue-next';
import { computed, onMounted, onUnmounted, ref } from 'vue';

type NavLink = { label: string; path: string; hash?: string };

const isScrolled = ref(false);
const isOpen = ref(false);
const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

const navLinks: NavLink[] = [
    { label: 'Layanan', path: '/', hash: 'layanan' },
    { label: 'Lokasi', path: '/locations' },
    { label: 'Karir', path: '/karir' },
];

const currentPath = computed(() => usePage().url.replace(/[?#].*$/, ''));
const isActive = (path: string) => currentPath.value === path;

function go(link: NavLink) {
    isOpen.value = false;
    if (currentPath.value === link.path) {
        if (link.hash) scrollToHash(link.hash);
    } else {
        router.visit(link.path, {
            onSuccess: () => link.hash && scrollToHash(link.hash),
        });
    }
}

function scrollToHash(hash: string) {
    const el = document.getElementById(hash);
    if (!el) return;
    const y = el.getBoundingClientRect().top + window.scrollY - 80;
    window.scrollTo({ top: y, behavior: 'smooth' });
}

onMounted(() => window.addEventListener('scroll', handleScroll));
onUnmounted(() => window.removeEventListener('scroll', handleScroll));
</script>
