import { Merchant } from './merchant';
import { Position } from './position';

export interface Job {
    id: number;
    merchant_id: number;
    merchant?: Merchant;
    position_id: number | null;
    position?: Position;
    description: string;
    slot: number;
    status: 'unavailable' | 'available';
    due_date: string;
    timestamp: string;
}
