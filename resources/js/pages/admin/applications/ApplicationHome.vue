<script setup lang="ts">
import applications from '@/routes/admin/applications';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    Application page
    <Link :href="applications.create()" >Buat</Link>
</template>
