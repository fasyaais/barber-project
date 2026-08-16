<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Field, FieldError, FieldGroup, FieldLabel, FieldSet } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AdminLayout from '@/layouts/AdminLayout.vue';
import users from '@/routes/admin/users';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineOptions({ layout: AdminLayout });

const page = usePage();
const errors = computed(() => page.props.errors || {});

const form = useForm<{
    fullname: string;
    username: string;
    email: string;
    no_whatsapp: string;
    role: 'admin' | 'owner' | '';
    password: string;
    password_confirmation: string;
}>({
    fullname: '',
    username: '',
    email: '',
    no_whatsapp: '',
    role: '',
    password: '',
    password_confirmation: '',
});

function submit() {
    form.post(users.store().url, {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Tambah Pengguna</h1>
            <p class="text-sm text-muted-foreground">Lengkapi data pengguna baru.</p>
        </div>
        <Card>
            <CardContent>
                <form @submit.prevent="submit" class="w-full space-y-4">
                    <FieldGroup>
                        <FieldSet>
                            <Field>
                                <FieldLabel for="fullname">Nama Lengkap</FieldLabel>
                                <Input
                                    id="fullname"
                                    v-model="form.fullname"
                                    placeholder="Masukkan nama lengkap.."
                                    :class="errors.fullname ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.fullname">{{ errors.fullname }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="username">Username</FieldLabel>
                                <Input
                                    id="username"
                                    v-model="form.username"
                                    placeholder="Masukkan username.."
                                    :class="errors.username ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.username">{{ errors.username }}</FieldError>
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

                            <Field>
                                <FieldLabel for="no_whatsapp">No WhatsApp</FieldLabel>
                                <Input
                                    id="no_whatsapp"
                                    v-model="form.no_whatsapp"
                                    placeholder="0895xxxxxxxxx"
                                    :class="errors.no_whatsapp ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.no_whatsapp">{{ errors.no_whatsapp }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="role">Role</FieldLabel>
                                <Select v-model="form.role">
                                    <SelectTrigger id="role" :class="errors.role ? 'border-red-500' : ''">
                                        <SelectValue placeholder="Pilih role..." />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="admin">Admin</SelectItem>
                                        <SelectItem value="owner">Owner</SelectItem>
                                    </SelectContent>
                                </Select>
                                <FieldError v-if="errors.role">{{ errors.role }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="password">Password</FieldLabel>
                                <Input
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    placeholder="Minimal 8 karakter"
                                    :class="errors.password ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.password">{{ errors.password }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel for="password_confirmation">Konfirmasi Password</FieldLabel>
                                <Input
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    placeholder="Ulangi password"
                                    :class="errors.password_confirmation ? 'border-red-500' : ''"
                                />
                                <FieldError v-if="errors.password_confirmation">{{ errors.password_confirmation }}</FieldError>
                            </Field>

                            <Field orientation="horizontal">
                                <Button type="submit" :disabled="form.processing">
                                    {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                                </Button>
                                <Link :href="users.index()">
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