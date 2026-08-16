<script setup lang="ts">
import AppearanceSwitcher from '@/components/AppearanceSwitcher.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { Separator } from '@/components/ui/separator';
import { SidebarInset, SidebarProvider, SidebarTrigger } from '@/components/ui/sidebar';
</script>

<template>
    <SidebarProvider>
        <AppSidebar />
        <SidebarInset>
            <header class="flex h-16 shrink-0 items-center gap-2 border-b bg-background px-4">
                <SidebarTrigger class="md:hidden" />
                <Separator orientation="vertical" class="mr-2 h-4" />
                <Breadcrumbs />
                <div class="ml-auto">
                    <AppearanceSwitcher />
                </div>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 md:p-6">
                <slot />
            </main>
        </SidebarInset>
    </SidebarProvider>
</template>
