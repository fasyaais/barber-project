<script setup lang="ts">
import AppSidebar from "@/components/AppSidebar.vue"
import Breadcrumbs from "@/components/Breadcrumbs.vue"
import { Separator } from "@/components/ui/separator"
import {
  SidebarInset,
  SidebarProvider,
  SidebarTrigger,
} from "@/components/ui/sidebar"
import { usePage } from "@inertiajs/vue3"
import { watch } from "vue"
import { toast, Toaster } from "vue-sonner"
import 'vue-sonner/style.css'

const page = usePage();

watch(
  () => page.props.flash,
  (flash) => {
    if (flash?.success) toast.success(flash.success)
    if (flash?.error) toast.error(flash.error)
    if (flash?.warning) toast.warning(flash.warning)
    if (flash?.info) toast.info(flash.info)
  },
  { deep: true, immediate: true }
)

</script>

<template>
  <SidebarProvider>
    <AppSidebar collapsible="offcanvas" />
    <SidebarInset >
        <Toaster position="top-center" />
      <header class="bg-background sticky top-0 flex h-16 shrink-0 items-center gap-2 border-b px-4">
        <SidebarTrigger class="-ml-1" />
        <Separator orientation="vertical" class="mr-2 h-4" />
        <Breadcrumbs />
      </header>
      <div class="flex flex-1 flex-col gap-4 p-4">
        <slot />
      </div>
    </SidebarInset>
</SidebarProvider>
</template>
