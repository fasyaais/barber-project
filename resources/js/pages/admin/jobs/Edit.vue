<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Field, FieldContent, FieldError, FieldLabel, FieldSet } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import AdminLayout from '@/layouts/AdminLayout.vue';
import jobs from '@/routes/admin/jobs';
import { Job } from '@/types/job';
import { Merchant } from '@/types/merchant';
import { Position } from '@/types/position';
import { Form } from '@inertiajs/vue3';

defineOptions({ layout: AdminLayout });

defineProps<{
    data: Job;
    merchants: Array<Merchant>;
    positions: Array<Position>;
    errors: object | null;
}>();
</script>

<template>
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Edit Pekerjaan</h1>
            <p class="text-sm text-muted-foreground">Perbarui data lowongan pekerjaan.</p>
        </div>
        <Card>
            <CardContent>
                <div v-if="errors && Object.keys(errors).length > 0" class="mb-4 rounded-md border border-red-200 bg-red-50 p-3 text-sm text-red-600 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-400">
                    {{ errors }}
                </div>
                <Form :action="jobs.update(data.id)" method="put" class="w-full space-y-4">
                    <FieldSet>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <Field>
                                <FieldLabel>Gerai</FieldLabel>
                                <FieldContent>
                                    <Select name="merchant_id">
                                        <SelectTrigger>
                                            <SelectValue :placeholder="data.merchant?.name" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem v-for="m in merchants ?? []" :key="m.id" :value="String(m.id)">
                                                {{ m.name }}
                                            </SelectItem>
                                        </SelectContent>
                                    </Select>
                                </FieldContent>
                                <FieldError v-for="error in (errors as any)?.merchant_id ?? []" :key="error">{{ error }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel>Posisi</FieldLabel>
                                <FieldContent>
                                    <Select name="position_id" :default-value="data.position_id ? String(data.position_id) : ''">
                                        <SelectTrigger>
                                            <SelectValue :placeholder="data.position?.name ?? 'Pilih Posisi'" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem v-for="p in positions ?? []" :key="p.id" :value="String(p.id)">
                                                {{ p.name }}
                                            </SelectItem>
                                        </SelectContent>
                                    </Select>
                                </FieldContent>
                                <FieldError v-for="error in (errors as any)?.position_id ?? []" :key="error">{{ error }}</FieldError>
                            </Field>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <Field>
                                <FieldLabel>Jumlah Slot</FieldLabel>
                                <FieldContent>
                                    <Input type="number" name="slot" :default-value="data.slot" placeholder="Jumlah pegawai untuk pegawai" />
                                </FieldContent>
                                <FieldError v-for="error in (errors as any)?.slot ?? []" :key="error">{{ error }}</FieldError>
                            </Field>

                            <Field>
                                <FieldLabel>Batas Waktu</FieldLabel>
                                <FieldContent>
                                    <Input type="date" name="due_date" :default-value="data.due_date" />
                                </FieldContent>
                                <FieldError v-for="error in (errors as any)?.due_date ?? []" :key="error">{{ error }}</FieldError>
                            </Field>
                        </div>

                        <Field>
                            <FieldLabel>Deskripsi</FieldLabel>
                            <FieldContent>
                                <Textarea name="description" :default-value="data.description" placeholder="Deskripsi" />
                            </FieldContent>
                            <FieldError v-for="error in (errors as any)?.description ?? []" :key="error">{{ error }}</FieldError>
                        </Field>

                        <Button type="submit">Simpan</Button>
                    </FieldSet>
                </Form>
            </CardContent>
        </Card>
    </div>
</template>
