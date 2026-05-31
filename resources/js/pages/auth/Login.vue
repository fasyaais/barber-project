<script setup lang="ts">
import { login } from '@/actions/App/Http/Controllers/AuthController';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import { Input } from '@/components/ui/input';
import Label from '@/components/ui/label/Label.vue';
import { Form, Head } from '@inertiajs/vue3';
import { Loader2 } from 'lucide-vue-next';

defineProps<{
    errors?: {message:string},
}>();

</script>
<template>
    <Head title="Admin" />
    <div class="w-dvw h-dvh flex justify-center items-center bg-primary/90">
        <Card class="md:w-1/5">
            <CardHeader>
                <CardTitle>
                    LOGIN
                </CardTitle>
                <CardDescription>
                    Selamat datang!
                </CardDescription>
            </CardHeader>
            <CardContent>
                <CardDescription v-if="errors?.message" class="text-red-600 mb-2" >{{ errors?.message }}</CardDescription>
                <Form :action="login()" class="flex flex-col gap-2" v-slot="{processing}">
                    <div class="grid w-full max-w-sm items-center gap-1.5">
                        <Label for="username">Username</Label>
                        <Input type="text" name="username" id="username" placeholder="Username" :class="{'border-red-500 focus:border-red-500 focus:ring-red-500 outline-red-500 focus:outline-red-500 text-red-500': errors?.message}" />
                    </div>
                    <div class="grid w-full max-w-sm items-center gap-1.5">
                        <Label for="password">Password</Label>
                        <Input type="password" name="password" id="password" placeholder="Password" :class="{'border-red-500 focus:border-red-500 focus:ring-red-500 outline-red-500 focus:outline-red-500 text-red-500': errors?.message}" />
                    </div>
                    <Button variant="default" class="bg-primary" :disabled="processing" >
                        <Loader2 class="h-4 w-4 animate-spin" v-if="processing"/> Login
                    </Button>
                </Form>
            </CardContent>
        </Card>
    </div>
</template>
