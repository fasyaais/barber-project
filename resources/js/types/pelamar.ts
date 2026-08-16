export interface Pelamar {
    id: number;
    job_id: number;
    name: string;
    cv: string;
    no_whatsapp: string;
    email: string;
    submited_at: string;
    job?: {
        position?: {
            name: string;
        };
    };
}