import { Injectable } from '@nestjs/common';
import { User } from './user.entity';

@Injectable()
export class UserRessource {
    static toArray(user: User) {
        return {
            id: user.id,
            name: user.name,
            email: user.email,
        };
    }

    static collection(users: User[]) {
        return users.map((user: User) => {
            return {
                id: user.id,
                name: user.name,
                email: user.email,
            };
        });
    }
}
