<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Field, FieldError, FieldGroup, FieldLabel, FieldSet } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { Progress } from '@/components/ui/progress';
import { Textarea } from '@/components/ui/textarea';
import AdminLayout from '@/layouts/AdminLayout.vue';
import products from '@/routes/admin/products';
import { Product } from '@/types/product';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    data: Product;
}>();

const page = usePage();
const errors = computed(() => page.props.errors || {});

const form = useForm<{
    name: string;
    description: string;
    price: string;
    image: File | undefined;
}>({
    name: props.data.name,
    description: props.data.description,
    price: props.data.price,
    image: undefined,
});

const imagePreview = ref<string | null>(props.data.image);

const previewImage = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        const file = target.files[0];
        form.image = file;

        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target?.result as string;
        };
        reader.readAsDataURL(file);
    }
};

function submit() {
    form.put(products.update(props.data.id).url, {
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
            <h1 class="text-2xl font-bold tracking-tight">Edit Produk</h1>
            <p class="text-sm text-muted-foreground">Perbarui data produk.</p>
        </div>
        <Card>
            <CardContent>
                <form @submit.prevent="submit" class="w-full space-y-4">
                    <FieldGroup>
                        <FieldSet>
                            <Field>
                                <FieldLabel for="product-name">Nama Produk</FieldLabel>
                                <Input
                                    id="product-name"
                                    v-model="form.name"
                                    placeholder="Masukkan nama produk.."
                                    :class="errors.name ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.name">{{ errors.name }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="product-description">Deskripsi</FieldLabel>
                                <Textarea
                                    id="product-description"
                                    v-model="form.description"
                                    placeholder="Masukkan deskripsi produk.."
                                    :class="errors.description ? 'border-red-500' : ''"
                                ></Textarea>
                                <FieldError v-if="errors.description">{{ errors.description }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="product-price">Harga</FieldLabel>
                                <Input
                                    id="product-price"
                                    v-model="form.price"
                                    placeholder="cth: 120K atau Rp 120.000"
                                    :class="errors.price ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.price">{{ errors.price }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="product-image">Gambar</FieldLabel>
                                <Input
                                    id="product-image"
                                    type="file"
                                    accept="image/*"
                                    @change="previewImage"
                                    :class="errors.image ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.image">{{ errors.image }}</FieldError>

                                <div v-if="imagePreview" class="mt-2">
                                    <img :src="imagePreview" alt="Preview" class="h-32 w-32 rounded-lg border object-cover" />
                                </div>

                                <Progress v-if="form.progress" :model-value="form.progress.percentage" class="mt-2" />
                            </Field>

                            <Field orientation="horizontal">
                                <Button type="submit" :disabled="form.processing">
                                    {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                                </Button>
                                <Link :href="products.index()">
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