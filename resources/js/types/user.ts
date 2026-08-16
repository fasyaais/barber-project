export interface User {
    id: string;
    fullname: string;
    username: string;
    no_whatsapp: string;
    email: string;
    password: string;
    role: 'admin' | 'owner';
}
