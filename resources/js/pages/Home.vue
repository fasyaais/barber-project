<template>
  <Head title="BladeCraft - Emerald White Edition" />

  <AppLayout>
    <section class="relative h-screen w-full flex items-center justify-center overflow-hidden bg-emerald-50/30">
      <div class="absolute inset-0 z-0 opacity-80">
        <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?q=80&w=2074" class="w-full h-full object-cover" />
      </div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/10 to-black"></div>

      <div class="relative z-10 text-center px-4 max-w-4xl">
        <span class="text-emerald-600 tracking-[0.4em] text-xs font-black uppercase mb-6 block">The Gentleman's Sanctuary</span>
        <h1 class="text-5xl md:text-8xl font-serif leading-tight text-slate-900 mb-8">
          Gaya Maskulin <br>
          <span class="text-emerald-600 italic font-medium underline decoration-emerald-100 underline-offset-8">Penampilan Prima</span>
        </h1>
        <p class="text-slate-600 text-lg md:text-xl max-w-2xl mx-auto mb-12 leading-relaxed font-light">
          Dedikasi kami untuk memberikan pengalaman grooming premium dengan sentuhan modern dan elegan.
        </p>
        <div class="flex flex-col sm:flex-row gap-5 justify-center">
          <a href="#layanan" class="bg-emerald-600 text-white font-bold py-4 px-12 rounded-full hover:bg-emerald-700 transition shadow-xl shadow-emerald-200">
            Lihat Layanan
          </a>
          <a href="#lokasi" class="bg-white border border-slate-200 py-4 px-12 rounded-full hover:bg-slate-50 transition text-slate-700 font-bold">
            Temukan Lokasi
          </a>
        </div>
      </div>
    </section>

    <section id="layanan" class="py-32 bg-white px-6">
      <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-6">
          <div class="max-w-xl">
            <h2 class="text-emerald-600 font-bold text-sm tracking-widest mb-3 uppercase">Layanan Eksklusif</h2>
            <h3 class="text-4xl md:text-5xl font-serif text-slate-900 italic">Menu Perawatan Kami</h3>
          </div>
          <p class="text-slate-500 max-w-sm italic">"Kerapihan adalah bentuk kesopanan tertinggi."</p>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
          <div v-for="service in services" :key="service.name" class="p-10 bg-white border border-slate-100 rounded-[2rem] hover:shadow-2xl hover:shadow-emerald-100 transition-all duration-500 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5">
               <svg class="w-20 h-20 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
            </div>
            <div class="flex justify-between items-center mb-6">
              <h4 class="text-2xl font-bold text-slate-800">{{ service.name }}</h4>
              <span class="text-emerald-600 font-bold text-lg">{{ service.price }}</span>
            </div>
            <p class="text-slate-500 leading-relaxed mb-6">{{ service.desc }}</p>
            <div class="h-1.5 w-12 bg-emerald-100 group-hover:w-full transition-all duration-500"></div>
          </div>
        </div>
      </div>
    </section>

    <section id="lokasi" class="py-32 bg-slate-50 px-6">
      <div class="max-w-6xl mx-auto">
        <h3 class="text-4xl font-serif text-slate-900 mb-16 text-center italic">Gerai Kami</h3>
        <div class="grid md:grid-cols-2 gap-8">
          <div v-for="loc in locations" :key="loc.name" class="bg-white p-2 rounded-[2.5rem] flex flex-col md:flex-row gap-8 items-center border border-emerald-50 hover:scale-[1.02] transition">
            <div class="w-full md:w-48 h-48 bg-emerald-600 rounded-[2.3rem] overflow-hidden flex-shrink-0 flex items-center justify-center text-white text-5xl font-serif italic">
               {{ loc.name.charAt(0) }}
            </div>
            <div class="p-6 md:p-0">
              <h4 class="text-2xl font-bold mb-3 text-slate-800">{{ loc.name }}</h4>
              <p class="text-slate-500 text-sm mb-6 leading-loose">{{ loc.address }}</p>
              <button class="inline-flex items-center gap-2 text-emerald-600 font-black text-xs uppercase tracking-widest group">
                Buka di Maps <span class="group-hover:translate-x-2 transition">→</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="karir" class="py-32 bg-white px-6">
      <div class="max-w-4xl mx-auto bg-emerald-600 p-12 md:p-20 rounded-[4rem] text-center shadow-2xl shadow-emerald-200">
        <h3 class="text-4xl font-serif italic text-white mb-6">Mulai Karirmu Disini</h3>
        <p class="text-emerald-50 mb-12 text-lg">Bergabunglah dengan standar grooming tertinggi di kota.</p>
        <div class="space-y-4">
          <div v-for="job in jobs" :key="job.title" class="flex justify-between items-center bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20 hover:bg-white/20 transition group">
            <div class="text-left">
              <h5 class="font-bold text-xl text-white">{{ job.title }}</h5>
              <p class="text-xs text-emerald-200 uppercase tracking-widest mt-1">{{ job.type }} • {{ job.loc }}</p>
            </div>
            <button class="bg-white text-emerald-700 font-black py-3 px-8 rounded-2xl hover:bg-emerald-50 transition shadow-lg">Apply</button>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const services = [
  { name: 'Classic Cut', price: '80K', desc: 'Konsultasi gaya, cuci rambut, potong, dan styling akhir.' },
  { name: 'Royal Shave', price: '65K', desc: 'Cukur jenggot tradisional menggunakan handuk panas & razor.' },
  { name: 'Gentle Care', price: '120K', desc: 'Paket potong rambut lengkap dengan pijat bahu dan masker wajah.' }
];

const locations = [
  { name: 'BladeCraft Senopati', address: 'Jl. Senopati Raya 12, Jakarta Selatan. Open 09.00 - 21.00' },
  { name: 'BladeCraft Dago', address: 'Jl. Ir. H. Juanda 88, Bandung. Open 10.00 - 20.00' }
];

const jobs = [
  { title: 'Master Barber', type: 'Full-time', loc: 'Senopati' },
  { title: 'Guest Relation', type: 'Part-time', loc: 'Dago' }
];
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
.font-serif { font-family: 'Playfair Display', serif; }
</style>
