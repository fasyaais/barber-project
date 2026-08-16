import appearance from '@/routes/appearance';
import { router, usePage } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

export type Appearance = 'light' | 'dark' | 'system';

const appearanceOptions: Appearance[] = ['light', 'dark', 'system'];

const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

function resolveIsDark(theme: Appearance): boolean {
    if (theme === 'dark') return true;
    if (theme === 'light') return false;
    return mediaQuery.matches;
}

function applyTheme(theme: Appearance) {
    document.documentElement.classList.toggle('dark', resolveIsDark(theme));
}

function useAppearance() {
    const page = usePage();

    const appearanceTheme = computed<Appearance>(() => {
        const value = page.props.appearance;
        return appearanceOptions.includes(value as Appearance) ? (value as Appearance) : 'system';
    });

    watch(
        appearanceTheme,
        (theme) => {
            applyTheme(theme);
        },
        { immediate: true }
    );

    mediaQuery.addEventListener('change', () => {
        applyTheme(appearanceTheme.value);
    });

    function updateAppearance(theme: Appearance) {
        router.post(
            appearance.update(),
            { appearance: theme },
            { preserveState: true, preserveScroll: true }
        );
    }

    return {
        appearanceTheme,
        updateAppearance,
    };
}

export { useAppearance };