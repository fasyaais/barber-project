export interface LocationBranch {
    name: string;
    address: string;
    image?: string | null;
    link?: string | null;
}

export const locations: LocationBranch[] = [
    { name: 'Tampan Senopati', address: 'Jl. Senopati Raya 12, Jakarta Selatan, Jakarta' },
    { name: 'Tampan Dago', address: 'Jl. Ir. H. Juanda 88, Bandung' },
    { name: 'Tampan Kelapa Gading', address: 'Jl. Raya Kelapa Gading Barat 21, Jakarta Utara' },
    { name: 'Tampan Kemang', address: 'Jl. Kemang Raya 7, Jakarta Selatan' },
    { name: 'Tampan Surabaya', address: 'Jl. Basuki Rahmat 45, Surabaya, Jawa Timur' },
    { name: 'Tampan Ubud', address: 'Jl. Raya Ubud 33, Gianyar, Bali' },
];

export function mapsUrl(loc: LocationBranch): string {
    return loc.link ?? `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(loc.address)}`;
}
