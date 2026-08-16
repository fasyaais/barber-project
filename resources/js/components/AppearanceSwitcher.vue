<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuRadioGroup,
    DropdownMenuRadioItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { useAppearance } from '@/composables/useAppearance';
import type { AcceptableValue } from 'reka-ui';
import { Monitor, Moon, Sun } from 'lucide-vue-next';
import { computed } from 'vue';

const { appearanceTheme, updateAppearance } = useAppearance();

function onThemeChange(theme: AcceptableValue) {
    if (theme === 'light' || theme === 'dark' || theme === 'system') {
        updateAppearance(theme);
    }
}

const currentIcon = computed(() => {
    if (appearanceTheme.value === 'dark') return Moon;
    if (appearanceTheme.value === 'light') return Sun;
    return Monitor;
});
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" size="icon" aria-label="Ganti tema">
                <component :is="currentIcon" class="size-4" />
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end" class="w-40">
            <DropdownMenuRadioGroup :model-value="appearanceTheme" @update:model-value="onThemeChange">
                <DropdownMenuRadioItem value="light">
                    <Sun />
                    Terang
                </DropdownMenuRadioItem>
                <DropdownMenuRadioItem value="dark">
                    <Moon />
                    Gelap
                </DropdownMenuRadioItem>
                <DropdownMenuRadioItem value="system">
                    <Monitor />
                    Sistem
                </DropdownMenuRadioItem>
            </DropdownMenuRadioGroup>
        </DropdownMenuContent>
    </DropdownMenu>
</template>