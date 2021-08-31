import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { getManager, Repository } from 'typeorm';
import { Sport } from './sport.entity';
import slugify from 'slugify';
import { Event } from '../event';

@Injectable()
export class SportService {
  constructor(
    @InjectRepository(Sport)
    private readonly sportRepository: Repository<Sport>,
  ) {}

  async index() {
    return this.sportRepository.find({ relations: ['event', 'event.scores']});
  }

  async find(slug) {
    return this.sportRepository.find({ where: { slug } });
  }

  async findOne(id) {
    return this.sportRepository.findOne({ where: { id } });
  }

  async filterSport() {
    const date = new Date().toLocaleDateString();
    const events = await Event.find({
      relations: ['category', 'category.sport'],
      where: { startAt: date.toString() },
    });
    const sport = [
      ...new Set(
        await events.map((e) => {
          return e.category.sport.id;
        }),
      ),
    ];
    const entityManager = getManager();
    return await entityManager
      .createQueryBuilder(Sport, 'sports')
      .where('sports.id IN (:...ids)', {
        ids: sport,
      })
      .getMany();
  }

  async store(data) {
    const sport = new Sport();
    sport.name = data.name;
    sport.slug = slugify(data.name);
    sport.content = data.content;
    return await sport.save();
  }

  async update(data, id) {
    const sport = await this.sportRepository.findOne({ where: { id } });
    sport.name = data.name;
    sport.slug = slugify(data.name);
    sport.content = data.content;
    return await sport.save();
  }

  async delete(id) {
    const sport = await Sport.findOne({ where: { id } });
    await sport.cat.forEach(async (eventCat) => {
      eventCat.delete = true;
      await eventCat.save();
    });
    sport.delete = true;
    return await sport.save();
    // return await this.sportRepository.delete(sport);
  }
}
