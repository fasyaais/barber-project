export interface JobRole {
    title: string;
    type: 'Full-time' | 'Part-time' | 'Freelance';
    loc: string;
    salary: string;
    desc: string;
}

export const jobs: JobRole[] = [
    {
        title: 'Master Barber',
        type: 'Full-time',
        loc: 'Senopati',
        salary: 'Rp 6 - 9 jt/bulan',
        desc: 'Lead barber berpengalaman dengan standar presisi tinggi untuk melayani pelanggan premium.',
    },
    {
        title: 'Guest Relation',
        type: 'Part-time',
        loc: 'Dago',
        salary: 'Rp 3 - 4.5 jt/bulan',
        desc: 'Menyambut tamu, mengelola janji temu, dan memastikan pengalaman kunjungan yang berkesan.',
    },
    {
        title: 'Barber Stylist',
        type: 'Full-time',
        loc: 'Kelapa Gading',
        salary: 'Rp 4 - 6 jt/bulan',
        desc: 'Ahli styling klasik hingga modern dengan fokus pada konsultasi gaya dan kepuasan pelanggan.',
    },
    {
        title: 'Shop Manager',
        type: 'Full-time',
        loc: 'Kemang',
        salary: 'Rp 8 - 11 jt/bulan',
        desc: 'Memimpin operasional gerai, tim, dan inventaris untuk menjaga standar layanan terbaik.',
    },
    {
        title: 'Content Creator',
        type: 'Freelance',
        loc: 'Remote',
        salary: 'Proyek / konten',
        desc: 'Membuat konten visual untuk media sosial dan kampanye branding Tampan yang engaging.',
    },
    {
        title: 'Receptionist',
        type: 'Part-time',
        loc: 'Ubud',
        salary: 'Rp 3 - 4 jt/bulan',
        desc: 'Mengelola jadwal, kasir, dan reservasi dengan keramahtamahan khas Tampan.',
    },
];