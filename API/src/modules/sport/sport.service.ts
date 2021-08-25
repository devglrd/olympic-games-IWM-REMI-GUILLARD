import {Injectable} from '@nestjs/common';
import {InjectRepository} from '@nestjs/typeorm';
import {Repository} from 'typeorm';
import {Sport} from './sport.entity';
import slugify from 'slugify';

@Injectable()
export class SportService {
    constructor(
        @InjectRepository(Sport)
        private readonly sportRepository: Repository<Sport>,
    ) {
    }

    async index() {
        return this.sportRepository.find({relations: ['event', 'event.scores']});
    }

    async find(slug) {
        return this.sportRepository.find({where: slug});
    }

    async store(data) {
        const sport = new Sport();
        sport.name = data.name;
        sport.slug = slugify(data.name);
        sport.content = data.content;
        return await sport.save();
    }

    async update(data, slug) {
        const sport = await this.sportRepository.findOne({where: {slug}});
        sport.name = data.name;
        sport.slug = slugify(data.name);
        sport.content = data.content;
        return await sport.save();
    }

    async delete(slug) {
        const sport = await this.sportRepository.findOne({where: {slug}});
        return await this.sportRepository.delete(sport);
    }
}
