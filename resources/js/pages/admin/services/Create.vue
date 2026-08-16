<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Field, FieldError, FieldGroup, FieldLabel, FieldSet } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { Progress } from '@/components/ui/progress';
import { Textarea } from '@/components/ui/textarea';
import AdminLayout from '@/layouts/AdminLayout.vue';
import services from '@/routes/admin/services';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

defineOptions({ layout: AdminLayout });

const page = usePage();
const errors = computed(() => page.props.errors || {});

const form = useForm<{
    name: string;
    description: string;
    img: File | undefined;
}>({
    name: '',
    description: '',
    img: undefined,
});

const imagePreview = ref<string | null>(null);

const previewImage = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        const file = target.files[0];
        form.img = file;

        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target?.result as string;
        };
        reader.readAsDataURL(file);
    }
};

function submit() {
    form.post(services.store().url, {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Tambah Layanan</h1>
            <p class="text-sm text-muted-foreground">Lengkapi data layanan baru.</p>
        </div>
        <Card>
            <CardContent>
                <form @submit.prevent="submit" class="w-full space-y-4">
                    <FieldGroup>
                        <FieldSet>
                            <Field>
                                <FieldLabel for="service-name">Nama Layanan</FieldLabel>
                                <Input
                                    id="service-name"
                                    v-model="form.name"
                                    placeholder="Masukkan nama layanan.."
                                    :class="errors.name ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.name">{{ errors.name }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="service-description">Deskripsi</FieldLabel>
                                <Textarea
                                    id="service-description"
                                    v-model="form.description"
                                    placeholder="Masukkan deskripsi layanan.."
                                    :class="errors.description ? 'border-red-500' : ''"
                                ></Textarea>
                                <FieldError v-if="errors.description">{{ errors.description }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="service-image">Gambar</FieldLabel>
                                <Input
                                    id="service-image"
                                    type="file"
                                    accept="image/*"
                                    @change="previewImage"
                                    :class="errors.img ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.img">{{ errors.img }}</FieldError>

                                <div v-if="imagePreview" class="mt-2">
                                    <img :src="imagePreview" alt="Preview" class="h-32 w-32 rounded-lg border object-cover" />
                                </div>

                                <Progress v-if="form.progress" :model-value="form.progress.percentage" class="mt-2" />
                            </Field>

                            <Field orientation="horizontal">
                                <Button type="submit" :disabled="form.processing">
                                    {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                                </Button>
                                <Link :href="services.index()">
                                    <Button type="button" variant="destructive">Batal</Button>
                                </Link>
                            </Field>
                        </FieldSet>
                    </FieldGroup>
                </form>
            </CardContent>
        </Card>
    </div>
</template>