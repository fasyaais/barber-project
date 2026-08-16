<template>
    <Head title="Lamarr Sekarang | Tampan Barbershop" />

    <AppLayout>
        <section class="bg-slate-50 px-6 py-16 md:py-24">
            <div class="mx-auto max-w-3xl">
                <div class="mb-12 text-center">
                    <h2 class="mb-3 text-sm font-bold tracking-widest text-emerald-600 uppercase">Karier & Lowongan</h2>
                    <h3 class="font-serif text-3xl leading-tight text-slate-900 italic sm:text-4xl md:text-5xl">Lamar Sekarang</h3>
                    <p class="mx-auto mt-6 max-w-xl leading-relaxed text-slate-500">
                        Lengkapi formulir di bawah dan tim kami akan segera menghubungi Anda. Pastikan berkas CV dalam format PDF, DOC, atau
                        DOCX (maks. 2MB).
                    </p>
                </div>

                <div
                    v-if="flash?.success"
                    class="mb-8 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-5 text-emerald-800"
                >
                    <CheckCircle2 class="mt-0.5 size-5 flex-shrink-0 text-emerald-600" />
                    <div>
                        <p class="font-bold">Lamaran Terkirim</p>
                        <p class="mt-1 text-sm text-emerald-700">{{ flash.success }}</p>
                    </div>
                </div>

                <form
                    @submit.prevent="submit"
                    class="rounded-3xl border border-slate-100 bg-white p-7 shadow-sm sm:p-10"
                    enctype="multipart/form-data"
                >
                    <div class="grid gap-6 md:grid-cols-2">
                        <Field>
                            <FieldLabel for="posisi">Posisi</FieldLabel>
                            <Select v-model="form.job_id">
                                <SelectTrigger id="posisi" :class="errors.job_id ? 'border-red-500' : ''">
                                    <SelectValue placeholder="Pilih posisi..." />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="job in jobs" :key="job.id" :value="String(job.id)">
                                        {{ job.position?.name }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                            <FieldError v-if="errors.job_id">{{ errors.job_id }}</FieldError>
                        </Field>

                        <Field>
                            <FieldLabel for="nama">Nama Lengkap</FieldLabel>
                            <Input
                                id="nama"
                                v-model="form.name"
                                placeholder="Masukkan nama lengkap.."
                                :class="errors.name ? 'border-red-500' : ''"
                            />
                            <FieldError v-if="errors.name">{{ errors.name }}</FieldError>
                        </Field>

                        <Field>
                            <FieldLabel for="whatsapp">No WhatsApp</FieldLabel>
                            <Input
                                id="whatsapp"
                                v-model="form.no_whatsapp"
                                placeholder="0895xxxxxxxxx"
                                :class="errors.no_whatsapp ? 'border-red-500' : ''"
                            />
                            <FieldError v-if="errors.no_whatsapp">{{ errors.no_whatsapp }}</FieldError>
                        </Field>

                        <Field>
                            <FieldLabel for="email">Email</FieldLabel>
                            <Input
                                id="email"
                                v-model="form.email"
                                type="email"
                                placeholder="nama@email.com"
                                :class="errors.email ? 'border-red-500' : ''"
                            />
                            <FieldError v-if="errors.email">{{ errors.email }}</FieldError>
                        </Field>

                        <Field class="md:col-span-2">
                            <FieldLabel for="cv">Unggah CV</FieldLabel>
                            <Input
                                id="cv"
                                type="file"
                                accept=".pdf,.doc,.docx"
                                @change="handleCv"
                                :class="errors.cv ? 'border-red-500' : ''"
                            />
                            <p class="mt-1 text-xs text-slate-400">PDF, DOC, atau DOCX · maksimal 2MB.</p>
                            <FieldError v-if="errors.cv">{{ errors.cv }}</FieldError>
                            <Progress v-if="form.progress" :model-value="form.progress.percentage" class="mt-2" />
                        </Field>
                    </div>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <Link
                            :href="'/karir'"
                            class="inline-flex items-center justify-center rounded-full border border-slate-300 px-8 py-3.5 text-sm font-bold text-slate-700 transition hover:border-emerald-600 hover:text-emerald-600"
                        >
                            Batal
                        </Link>
                        <Button type="submit" :disabled="form.processing" class="rounded-full px-10 py-3.5">
                            {{ form.processing ? 'Mengirim...' : 'Kirim Lamaran' }}
                        </Button>
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Field, FieldError, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { Progress } from '@/components/ui/progress';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { CheckCircle2 } from 'lucide-vue-next';
import { computed } from 'vue';

interface Position {
    id: number;
    name: string;
}

interface JobOption {
    id: number;
    position?: Position;
}

const props = defineProps<{
    jobs: JobOption[];
}>();

const page = usePage();
const errors = computed(() => page.props.errors || {});
const flash = computed(() => page.props.flash || {});

const form = useForm<{
    job_id: string | undefined;
    name: string;
    email: string;
    no_whatsapp: string;
    cv: File | undefined;
}>({
    job_id: undefined,
    name: '',
    email: '',
    no_whatsapp: '',
    cv: undefined,
});

const posisiParam = new URLSearchParams(window.location.search).get('posisi');
const preselectedJob = computed(() => {
    if (!posisiParam) return undefined;
    return props.jobs.find((job) => job.position?.name.toLowerCase() === posisiParam.toLowerCase());
});
if (preselectedJob.value) {
    form.job_id = String(preselectedJob.value.id);
}

function handleCv(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        form.cv = target.files[0];
    }
}

function submit() {
    form.post('/lamar', {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
.font-serif {
    font-family: 'Playfair Display', serif;
}
</style>