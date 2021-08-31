import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Sport } from '../sport';
import { Repository } from 'typeorm';
import { Event } from './event.entity';
import { EventCategory } from './eventCategory.entity';
import moment from 'moment';
import slugify from 'slugify';

@Injectable()
export class CategoryService {
  constructor(
    @InjectRepository(Event)
    private readonly eventRepository: Repository<Event>,
    @InjectRepository(EventCategory)
    private readonly eventCategoryRepository: Repository<EventCategory>,
  ) {}

  async index() {
    return this.eventCategoryRepository.find({ relations: ['sport'] });
  }

  async find(id) {
    return this.eventCategoryRepository.findOne({ where: { id } });
  }
  async filterSport(id) {
    return this.eventCategoryRepository.find({
      relations: ['sport'],
      where: { sport: { id } },
    });
  }

  async store(data) {
    const sport = await Sport.findOne({ where: { id: data.sport } });
    const eventCategory = new EventCategory();

    eventCategory.name = data.name;
    eventCategory.type = data.type;
    eventCategory.slug = slugify(data.name);
    if (sport) {
      eventCategory.sport = sport;
    }
    return await eventCategory.save();
  }

  async update(data, id) {
    const sport = await Sport.findOne({ where: { slug: data.sport } });
    const eventCategory = await EventCategory.findOne({ where: { id } });

    eventCategory.name = data.name;
    eventCategory.type = data.type;
    eventCategory.slug = slugify(data.name);
    if (sport) {
      eventCategory.sport = sport;
    }
    return await eventCategory.save();
  }

  async delete(id) {
    const eventCategory = await EventCategory.findOne({ where: { id } });
    eventCategory.delete = true;
    return await eventCategory.save();
  }
}
