<template>
  <section class="py-24 bg-gray-950 px-6 text-white">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-3xl font-serif mb-12 border-l-4 border-emerald-500 pl-4">Gerai Kami</h2>
      <div class="grid md:grid-cols-2 gap-12">
        <div v-for="loc in locations" :key="loc.name" class="flex gap-6 items-center bg-gray-900 p-6 rounded-2xl">
          <div class="w-24 h-24 bg-emerald-500/20 rounded-full flex items-center justify-center text-3xl">📍</div>
          <div>
            <h4 class="text-xl font-bold">{{ loc.name }}</h4>
            <p class="text-gray-400 text-sm mb-4">{{ loc.address }}</p>
            <a :href="loc.mapUrl" class="text-emerald-400 text-xs font-bold hover:underline">LIHAT DI GOOGLE MAPS →</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const locations = [
  { name: 'BladeCraft Senopati', address: 'Jl. Senopati No. 12, Jakarta Selatan', mapUrl: '#' },
  { name: 'BladeCraft Dago', address: 'Jl. Ir. H. Juanda No. 88, Bandung', mapUrl: '#' },
];
</script>
