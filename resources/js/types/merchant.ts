import { User } from './user';

export interface Merchant {
    id: string;
    name: string;
    user: User;
}
