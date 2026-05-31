<script setup lang="ts">
import type { SidebarProps } from "@/components/ui/sidebar"

import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from "@/components/ui/collapsible"

import {
  ChevronRight,
  BookOpen,
  Frame,
  Map,
  PieChart,
  Settings2,
  SquareTerminal,
  Store,
  Users,
  LayoutDashboard,
} from "lucide-vue-next"

import {
  Sidebar,
  SidebarContent,
  SidebarHeader,
  SidebarRail,
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarMenuSub,
  SidebarMenuSubButton,
  SidebarMenuSubItem,
} from "@/components/ui/sidebar"
import users from "@/routes/admin/users";
import merchants from "@/routes/admin/merchants";
import admin from "@/routes/admin";
import { Link } from "@inertiajs/vue3";

const props = withDefaults(defineProps<SidebarProps>(), {
  collapsible: "icon",
})
const data = {
  user: {
    name: "shadcn",
    email: "m@example.com",
    avatar: "/avatars/shadcn.jpg",
  },
  navMain: [
    {
      title: "Pengguna",
      url: "#",
      icon: Users,
      isActive: false,
      items: [
        {
          title: "Daftar Pengguna",
          url: users.index().url,
        },
        {
          title: "Tambah Pengguna",
          url: users.create().url,
        },
      ],
    },
    {
      title: "Gerai",
      url: "#",
      icon: Store,
      items: [
        {
          title: "Daftar Gerai",
          url: merchants.index().url,
        },
        {
          title: "Buat Gerai",
          url: merchants.create().url,
        },
      ],
    },
    {
      title: "Documentation",
      url: "#",
      icon: BookOpen,
      items: [
        {
          title: "Introduction",
          url: "#",
        },
        {
          title: "Get Started",
          url: "#",
        },
        {
          title: "Tutorials",
          url: "#",
        },
        {
          title: "Changelog",
          url: "#",
        },
      ],
    },
    {
      title: "Settings",
      url: "#",
      icon: Settings2,
      items: [
        {
          title: "General",
          url: "#",
        },
        {
          title: "Team",
          url: "#",
        },
        {
          title: "Billing",
          url: "#",
        },
        {
          title: "Limits",
          url: "#",
        },
      ],
    },
  ],
  projects: [
    {
      name: "Design Engineering",
      url: "#",
      icon: Frame,
    },
    {
      name: "Sales & Marketing",
      url: "#",
      icon: PieChart,
    },
    {
      name: "Travel",
      url: "#",
      icon: Map,
    },
  ],
}
</script>

<template>
  <Sidebar v-bind="props">
    <SidebarHeader>
      <h1>Tampan</h1>
    </SidebarHeader>
    <SidebarContent>
      <SidebarGroup>
        <SidebarMenu>
            <SidebarMenuItem>
              <SidebarMenuButton>
                <component :is="LayoutDashboard" />
                <Link :href="admin.dashboard().url">Dashboard</Link>
              </SidebarMenuButton>
            </SidebarMenuItem>
        <Collapsible
            v-for="item in data.navMain"
            :key="item.title"
            as-child
            :default-open="item.isActive"
            class="group/collapsible"
        >
            <SidebarMenuItem>
            <CollapsibleTrigger as-child>
                <SidebarMenuButton :tooltip="item.title">
                <component :is="item.icon" v-if="item.icon" />
                <span>{{ item.title }}</span>
                <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                </SidebarMenuButton>
            </CollapsibleTrigger>
            <CollapsibleContent>
                <SidebarMenuSub>
                <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                    <SidebarMenuSubButton as-child>
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
    </SidebarGroup>
    </SidebarContent>
    <SidebarRail />
  </Sidebar>
</template>
