import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Sport } from '../sport';
import { Repository } from 'typeorm';
import { Event } from './event.entity';
import { EventCategory } from './eventCategory.entity';
import moment from 'moment';

@Injectable()
export class EventService {
  constructor(
    @InjectRepository(Event)
    private readonly eventRepository: Repository<Event>,
    @InjectRepository(EventCategory)
    private readonly eventCategoryRepository: Repository<EventCategory>,
  ) {}

  async index() {
    return this.eventRepository.find();
  }

  async store(data) {
    const sport = await Sport.findOne({ where: { slug: data.sport } });
    const event = new Event();
    const eventCategory = await this.eventCategoryRepository.findOne({
      where: { slug: data.event },
    });
    event.name = data.name;
    event.location = data.location;
    event.startAt = new Date(data.startAt);
    event.time = new Date(data.startAt).toLocaleTimeString();
    event.content = data.content;
    if (sport) {
      event.sport = sport;
    }
    if (event) {
      event.category = eventCategory;
    }
    return await event.save();
  }

  async update(data, id) {
    const sport = await Sport.findOne({ where: { slug: data.sport } });
    const event = await Event.findOne({ where: { id } });
    const eventCategory = await this.eventCategoryRepository.findOne({
      where: { slug: data.event },
    });

    event.name = data.name;
    event.location = data.location;
    event.startAt = new Date(data.startAt);
    event.time = new Date(data.startAt).toLocaleTimeString();
    event.content = data.content;
    if (sport) {
      event.sport = sport;
    }
    if (event) {
      event.category = eventCategory;
    }
    return await event.save();
  }

  async delete(id) {
    const event = await Event.findOne({ where: { id } });
    return await this.eventRepository.delete(event);
  }
}
