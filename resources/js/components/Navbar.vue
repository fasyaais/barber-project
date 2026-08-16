<script setup lang="ts">
import { Button } from './ui/button';
import { NavigationMenu, NavigationMenuItem, NavigationMenuLink, NavigationMenuList } from './ui/navigation-menu';
</script>

<template>
    <header class="container mx-auto my-2 flex h-12 items-center justify-between gap-3">
        <div class="align-content-center flex">
            <h3 class="text-center text-2xl font-bold">TAMPAN</h3>
        </div>
        <NavigationMenu class="">
            <NavigationMenuList>
                <NavigationMenuItem class="flex gap-3">
                    <NavigationMenuLink as-child>
                        <a href="/#docs">Beranda</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child>
                        <a href="/#docs">Layanan</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child>
                        <a href="/#docs">Lokasi</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child>
                        <a href="/#docs">Gerai</a>
                    </NavigationMenuLink>
                    <NavigationMenuLink as-child>
                        <a href="/#docs">Karir</a>
                    </NavigationMenuLink>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>
        <Button>Sign up</Button>
    </header>
</template>
