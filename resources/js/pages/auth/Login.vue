<script setup lang="ts">
import { login } from '@/actions/App/Http/Controllers/AuthController';
import AppearanceSwitcher from '@/components/AppearanceSwitcher.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import { Input } from '@/components/ui/input';
import Label from '@/components/ui/label/Label.vue';
import { Form, Head } from '@inertiajs/vue3';
import { Eye, EyeOff, Loader2, Lock, Scissors, User } from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{
    errors?: { message: string };
}>();

const showPassword = ref(false);
</script>
<template>
    <Head title="Admin" />
    <div class="grid min-h-dvh lg:grid-cols-2">
        <div class="absolute top-4 right-4 z-10">
            <AppearanceSwitcher />
        </div>
        <div class="hidden flex-col justify-between bg-primary p-12 text-primary-foreground lg:flex">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-primary-foreground/10">
                    <Scissors class="size-5" />
                </div>
                <span class="text-2xl font-semibold tracking-tight">Tampan</span>
            </div>

            <div class="max-w-md">
                <h1 class="text-4xl leading-tight font-bold">Kelola gerai barber Anda dari satu tempat.</h1>
                <p class="mt-4 text-primary-foreground/80">
                    Platform manajemen untuk gerai, produk, dan tim — semuanya dalam satu dashboard yang rapi dan mudah digunakan.
                </p>
            </div>

            <p class="text-sm text-primary-foreground/70">&copy; 2026 Tampan. Semua hak dilindungi.</p>
        </div>

        <div class="flex items-center justify-center bg-background p-6 md:p-10">
            <div class="w-full max-w-md">
                <div class="mb-8 flex items-center justify-center gap-3 lg:hidden">
                    <div class="flex size-10 items-center justify-center rounded-lg bg-primary text-primary-foreground">
                        <Scissors class="size-5" />
                    </div>
                    <span class="text-2xl font-semibold tracking-tight">Tampan</span>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle class="text-2xl">Login</CardTitle>
                        <CardDescription>Masuk untuk mengelola dashboard admin Anda.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <CardDescription v-if="errors?.message" class="mb-4 rounded-md border border-red-200 bg-red-50 p-3 text-sm text-red-600 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-400">
                            {{ errors?.message }}
                        </CardDescription>
                        <Form :action="login()" class="flex flex-col gap-4" v-slot="{ processing }">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="username">Username</Label>
                                <div class="relative">
                                    <User class="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground" />
                                    <Input
                                        type="text"
                                        name="username"
                                        id="username"
                                        placeholder="Masukkan username"
                                        class="pl-10"
                                        :class="{
                                            'border-red-500 text-red-500 outline-red-500 focus:border-red-500 focus:ring-red-500 focus:outline-red-500':
                                                errors?.message,
                                        }"
                                    />
                                </div>
                            </div>
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="password">Password</Label>
                                <div class="relative">
                                    <Lock class="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground" />
                                    <Input
                                        :type="showPassword ? 'text' : 'password'"
                                        name="password"
                                        id="password"
                                        placeholder="Masukkan password"
                                        class="pr-10 pl-10"
                                        :class="{
                                            'border-red-500 text-red-500 outline-red-500 focus:border-red-500 focus:ring-red-500 focus:outline-red-500':
                                                errors?.message,
                                        }"
                                    />
                                    <button
                                        type="button"
                                        class="absolute top-1/2 right-3 -translate-y-1/2 text-muted-foreground transition-colors hover:text-foreground"
                                        :aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
                                        @click="showPassword = !showPassword"
                                    >
                                        <EyeOff v-if="showPassword" class="size-4" />
                                        <Eye v-else class="size-4" />
                                    </button>
                                </div>
                            </div>
                            <Button type="submit" class="w-full" :disabled="processing">
                                <Loader2 v-if="processing" class="h-4 w-4 animate-spin" />
                                {{ processing ? 'Memproses...' : 'Login' }}
                            </Button>
                        </Form>
                    </CardContent>
                </Card>
            </div>
        </div>
    </div>
</template>
