<template>
  <div class="min-h-screen bg-white text-slate-900 font-sans selection:bg-emerald-100 selection:text-emerald-900">

    <nav
      :class="[
        'fixed w-full z-50 transition-all duration-300 px-6 py-4 md:px-12 flex items-center justify-between ',
        isScrolled ? 'bg-white/80 backdrop-blur-md py-3 shadow-sm border-b border-emerald-50' : 'bg-transparent'
      ]"
    >
      <div class="flex items-center gap-2 group cursor-pointer">
        <div class="text-emerald-600 border-2 border-emerald-600 p-1 rounded transition-transform group-hover:rotate-12">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758L5 19m0-14l4.121 4.121" />
          </svg>
        </div>
        <span class="font-bold tracking-tighter text-xl uppercase text-slate-800">Blade<span class="text-emerald-600">Craft</span></span>
      </div>

      <div class="hidden md:flex gap-8 text-xs font-bold uppercase tracking-widest text-slate-500">
        <a href="#layanan" class="hover:text-emerald-600 transition">Layanan</a>
        <a href="#lokasi" class="hover:text-emerald-600 transition">Lokasi</a>
        <a href="#karir" class="hover:text-emerald-600 transition">Karir</a>
      </div>

      <button class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-full text-sm transition shadow-md shadow-emerald-200">
        Pesan Sekarang
      </button>
    </nav>

    <main>
      <slot />
    </main>

    <footer class="bg-slate-50 py-12 border-t border-slate-100 text-center">
      <p class="text-slate-400 text-sm">© 2024 BladeCraft Barbershop. Elegance in Every Cut.</p>
    </footer>
  </div>
</template>

<script setup lang="ts">
    import { ref, onMounted, onUnmounted } from 'vue';
    const isScrolled = ref(false);
    const handleScroll = () => { isScrolled.value = window.scrollY > 50 };
    onMounted(() => window.addEventListener('scroll', handleScroll));
    onUnmounted(() => window.removeEventListener('scroll', handleScroll));
</script>
