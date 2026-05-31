<template>
  <section class="py-24 bg-black text-white px-6">
    <div class="max-w-4xl mx-auto bg-emerald-500/5 border border-emerald-500/20 p-12 rounded-3xl">
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold">Bergabung Bersama Kami</h2>
        <p class="text-gray-400 mt-2">Kami mencari talenta terbaik untuk memberikan pelayanan prima.</p>
      </div>

      <div class="space-y-4">
        <div v-for="job in jobs" :key="job.title" class="flex justify-between items-center p-6 bg-gray-900 rounded-xl hover:bg-gray-800 transition">
          <div>
            <h4 class="font-bold text-lg">{{ job.title }}</h4>
            <span class="text-emerald-500 text-xs uppercase">{{ job.type }}</span>
          </div>
          <button class="bg-white text-black px-6 py-2 rounded-full font-bold text-sm hover:bg-emerald-400 transition">
            Lamar Sekarang
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const jobs = [
  { title: 'Senior Barber', type: 'Full-time' },
  { title: 'Shop Manager', type: 'Full-time' },
  { title: 'Content Creator', type: 'Freelance' },
];
</script>
