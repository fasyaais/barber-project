<script lang="ts" setup>
import admin from '@/routes/admin';
import type { PageProps } from '@inertiajs/core';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbPage, BreadcrumbSeparator } from './ui/breadcrumb';

type BreadcrumbItem = {
    name: string;
    href?: string;
};

interface CustomPageProps extends PageProps {
    breadcrumbs?: BreadcrumbItem[];
}

const page = usePage<CustomPageProps>();

const breadcrumbs = computed<BreadcrumbItem[]>(() => {
    return page.props.breadcrumbs ?? [];
});
</script>

<template>
    <Breadcrumb v-if="breadcrumbs.length">
        <BreadcrumbList>
            <BreadcrumbItem>
                <BreadcrumbLink as-child>
                    <Link :href="admin.dashboard()"> Dashboard </Link>
                </BreadcrumbLink>
            </BreadcrumbItem>
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <BreadcrumbSeparator class="hidden md:block" />

                <BreadcrumbItem>
                    <template v-if="item.href">
                        <BreadcrumbLink as-child>
                            <Link :href="item.href">
                                {{ item.name }}
                            </Link>
                        </BreadcrumbLink>
                    </template>

                    <template v-else>
                        <BreadcrumbPage>
                            {{ item.name }}
                        </BreadcrumbPage>
                    </template>
                </BreadcrumbItem>
            </template>
        </BreadcrumbList>
    </Breadcrumb>
</template>
