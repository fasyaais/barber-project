<script setup lang="ts">
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { SidebarMenu, SidebarMenuButton, SidebarMenuItem, SidebarMenuSub, SidebarMenuSubButton, SidebarMenuSubItem } from '@/components/ui/sidebar';
import { Link, usePage } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';
import { ChevronRight } from 'lucide-vue-next';
import { ref, watch } from 'vue';

const props = defineProps<{
    items: {
        title: string;
        url: string;
        icon?: LucideIcon;
        items?: {
            title: string;
            url: string;
        }[];
    }[];
}>();

const page = usePage();

const isParentActive = (item: { title: string; url: string }): boolean => {
    return page.url.startsWith(item.url);
};

const open = ref(props.items.map((item) => isParentActive(item)));
watch(
    () => page.url,
    () => {
        props.items.forEach((item, index) => {
            if (isParentActive(item)) {
                open.value[index] = true;
            }
        });
    },
);
</script>

<template>
    <SidebarMenu>
        <Collapsible
            v-for="(item, index) in items"
            :key="item.title"
            as-child
            :open="open[index]"
            @update:open="(value) => (open[index] = value)"
            class="group/collapsible"
        >
            <SidebarMenuItem>
                <CollapsibleTrigger as-child>
                    <SidebarMenuButton :tooltip="item.title" :is-active="isParentActive(item)">
                        <component :is="item.icon" v-if="item.icon" />
                        <span>{{ item.title }}</span>
                        <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                    </SidebarMenuButton>
                </CollapsibleTrigger>
                <CollapsibleContent>
                    <SidebarMenuSub>
                        <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                            <SidebarMenuSubButton as-child :is-active="page.url === subItem.url">
                                <Link :href="subItem.url">
                                    <span>{{ subItem.title }}</span>
                                </Link>
                            </SidebarMenuSubButton>
                        </SidebarMenuSubItem>
                    </SidebarMenuSub>
                </CollapsibleContent>
            </SidebarMenuItem>
        </Collapsible>
    </SidebarMenu>
</template>
