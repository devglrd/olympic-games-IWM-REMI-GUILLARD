import {Injectable, Logger} from '@nestjs/common';
import {User} from '../user';
import {Repository} from 'typeorm';
import {InjectRepository} from '@nestjs/typeorm';

@Injectable()
export class SeedsService {
    constructor(
        @InjectRepository(User)
        private readonly userRepository: Repository<User>,
        private readonly logger: Logger,
    ) {
    }

    async seed() {
        this.logger.debug('Run seeds');
        const users = await this.seedUser();
        this.logger.debug('Successfuly completed seeding users...');
    }

    async seedUser() {
        const users = [];
        this.logger.debug('Clear users tables ...');
        this.userRepository.clear();
        const user = new User();
        user.email = `admin@olympicgames.com`;
        user.name = 'admin';
        user.password = 'olympicgames2024+!';
        await user.save();
        users.push(user);
        return users;
    }
}
