<script lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Merchant } from '@/types/merchant';
export default {
  layout: AdminLayout
}
</script>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Progress } from '@/components/ui/progress';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { CheckIcon, ChevronsUpDownIcon } from 'lucide-vue-next';
import { cn } from '@/lib/utils';
import { Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList } from '@/components/ui/command';
import { Field, FieldError, FieldGroup, FieldLabel, FieldSet, FieldTitle } from '@/components/ui/field';

import { Textarea } from '@/components/ui/textarea';
import admin from '@/routes/admin';


const props = defineProps<{
  users: any[],
  data: any
}>();

const page = usePage();

const form = useForm<{
  name: string | undefined,
  user_id: string | undefined,
  locate: string | undefined,
  img: File | undefined,
}>({
  name: props.data.name,
  user_id: props.data.user_id,
  locate: props.data.locate,
  img: undefined,
});


function submit() {
  form.post('/admin/merchants', {
    forceFormData: true,
    onSuccess: () => {
      form.reset();
    },
  });
}

const errors = computed(() => page.props.errors || {});

const openComboBox = ref(false);
const value = ref<string | null>(props.data.user_id);

const selectedUser = computed(() => {
  return props.users.find(u => u.id === value.value);
});

const imagePreview = ref<string | null>(props.data.img);

const previewImage = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    const file = target.files[0];
    form.img = file;

    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target?.result as string;
    };
    reader.readAsDataURL(file);
  }
};


</script>



<template>
  <Card>
    <CardContent class="flex">
      <form @submit.prevent="submit" class="w-full space-y-4">
        <FieldGroup>
          <FieldTitle>Edit Gerai</FieldTitle>
          <FieldSet>
            <!-- Nama Gerai -->
            <Field>
              <FieldLabel for="merchant-name">
                Nama Gerai
              </FieldLabel>
              <Input
                id="merchant-name"
                v-model="form.name"
                placeholder="Masukkan nama gerai.."
                :class="errors.name ? 'border-red-500' : ''"
              />
              <FieldError v-if="errors.name">
                {{ errors.name }}
              </FieldError>
            </Field>

            <!-- Pemilik -->
            <Field>
              <FieldLabel>
                Pemilik
              </FieldLabel>
              <Popover v-model:open="openComboBox">
                <PopoverTrigger as-child>
                  <Button
                    variant="outline"
                    role="combobox"
                    type="button"
                    :aria-expanded="openComboBox"
                    :class="cn(
                      'w-[200px] justify-between',
                      errors.user_id ? 'border-red-500' : ''
                    )"
                  >
                    {{ selectedUser?.fullname || 'Pilih Owner' }}
                    <ChevronsUpDownIcon class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                  </Button>
                </PopoverTrigger>
                <PopoverContent class="w-[200px] p-0">
                  <Command>
                    <CommandInput placeholder="Pilih Owner..." />
                    <CommandList>
                      <CommandEmpty>Tidak memiliki user.</CommandEmpty>
                      <CommandGroup>
                        <CommandItem
                          v-for="user in users"
                          :key="user.id"
                          :value="user.id"
                          @select="() => {
                            form.user_id = value === user.id ? undefined : user.id
                            value = value === user.id ? null : user.id
                            openComboBox = false
                          }"
                        >
                          <CheckIcon
                            :class="cn(
                              'mr-2 h-4 w-4',
                              value === user.id ? 'opacity-100' : 'opacity-0',
                            )"
                          />
                          {{ user.fullname }}
                        </CommandItem>
                      </CommandGroup>
                    </CommandList>
                  </Command>
                </PopoverContent>
              </Popover>
              <FieldError v-if="errors.user_id">
                {{ errors.user_id }}
              </FieldError>
            </Field>

            <!-- Alamat Gerai -->
            <Field>
              <FieldLabel for="merchant-address">
                Alamat Gerai
              </FieldLabel>
              <Textarea id="merchant-address"
                v-model="form.locate"
                placeholder="Masukkan alamat lokasi.."
                :class="errors.locate ? 'border-red-500' : ''" ></Textarea>
              <FieldError v-if="errors.locate">
                {{ errors.locate }}
              </FieldError>
            </Field>

            <!-- Gambar -->
            <Field>
              <FieldLabel for="merchant-image">
                Gambar
              </FieldLabel>
              <Input
                id="merchant-image"
                type="file"
                accept="image/*"
                @change="previewImage"
                :class="errors.img ? 'border-red-500' : ''"
              />
              <FieldError v-if="errors.img">
                {{ errors.img }}
              </FieldError>

              <!-- Image Preview -->
              <div v-if="imagePreview" class="mt-2">
                <img
                  :src="imagePreview"
                  alt="Preview"
                  class="w-32 h-32 object-cover rounded-lg border"
                />
              </div>

              <!-- Upload Progress -->
              <Progress
                v-if="form.progress"
                :model-value="form.progress.percentage"
                class="mt-2"
              />
            </Field>
            <Field orientation="horizontal">
              <Button
                type="submit"
                :disabled="form.processing"
              >
                {{ form.processing ? 'Menyimpan...' : 'Edit' }}
              </Button>
                  <Link :href="admin.merchants.index()">
                    <Button variant="destructive"  type="button" as="true">
                        Batal
                    </Button>
                  </Link>
            </Field>
          </FieldSet>
        </FieldGroup>
      </form>
    </CardContent>
  </Card>
</template>
