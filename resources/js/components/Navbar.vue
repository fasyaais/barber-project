<script setup lang="ts">
import { Button } from './ui/button';
import { NavigationMenu, NavigationMenuItem, NavigationMenuLink, NavigationMenuList } from './ui/navigation-menu';

</script>

<template>
    <header class="flex gap-3 justify-between container mx-auto items-center h-12 my-2">
        <div class="flex align-content-center">
            <h3 class="text-center font-bold text-2xl">TAMPAN</h3>
        </div>
        <NavigationMenu class="">
            <NavigationMenuList>
                <NavigationMenuItem class="gap-3 flex">
                    <NavigationMenuLink as-child >
                        <a href="/#docs">Beranda</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child >
                        <a href="/#docs">Layanan</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child >
                        <a href="/#docs">Lokasi</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child >
                        <a href="/#docs">Gerai</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child >
                        <a href="/#docs">Karir</a>
                    </NavigationMenuLink>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>
        <Button>Sign up</Button>
    </header>
</template>
