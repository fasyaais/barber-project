export interface Auth {
    user: User;
}

export type Appearance = 'light' | 'dark' | 'system';

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    appearance: Appearance;
};
