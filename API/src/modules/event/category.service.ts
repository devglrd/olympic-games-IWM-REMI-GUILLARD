import {Injectable} from '@nestjs/common';
import {InjectRepository} from '@nestjs/typeorm';
import {Sport} from '../sport';
import {Repository} from 'typeorm';
import {Event} from './event.entity';
import {EventCategory} from './eventCategory.entity';
import moment from 'moment';
import slugify from "slugify";

@Injectable()
export class CategoryService {
    constructor(
        @InjectRepository(Event)
        private readonly eventRepository: Repository<Event>,
        @InjectRepository(EventCategory)
        private readonly eventCategoryRepository: Repository<EventCategory>,
    ) {
    }

    async index() {
        return this.eventCategoryRepository.find({relations: ['sport']});
    }

    async find(id){
        return this.eventCategoryRepository.findOne({where: {id}});
    }
    async filterSport(id) {
        return this.eventCategoryRepository.find({relations: ['sport'], where: {sport: {id}}});
    }

    async store(data) {
        const sport = await Sport.findOne({where: {id: data.sport}});
        const event = new EventCategory();

        event.name = data.name;
        event.type = data.type;
        event.slug = slugify(data.name);
        if (sport) {
            event.sport = sport;
        }
        return await event.save();
    }

    async update(data, id) {
        const sport = await Sport.findOne({where: {slug: data.sport}});
        const event = await EventCategory.findOne({where: {id}});

        event.name = data.name;
        event.type = data.type;
        event.slug = slugify(data.name);
        if (sport) {
            event.sport = sport;
        }
        return await event.save();
    }

    async delete(id) {
        const event = await Event.findOne({where: {id}});
        event.delete =true;
        return await event.save();
    }
}
