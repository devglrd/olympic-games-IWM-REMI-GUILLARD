import { HttpService, Injectable, Logger } from '@nestjs/common';
import { User } from '../user';
import { getConnection, QueryRunner, Repository } from 'typeorm';
import { InjectRepository } from '@nestjs/typeorm';
import { Sport } from '../sport';
import { Score } from '../score';
import { Event } from '../event';
import { map } from 'rxjs';
import slugify from 'slugify';
import { EventCategory, Type } from '../event/eventCategory.entity';

@Injectable()
export class SeedsService {
  private queryRuner: QueryRunner;

  constructor(
    @InjectRepository(User)
    private readonly userRepository: Repository<User>,
    @InjectRepository(Event)
    private readonly eventRepository: Repository<Event>,
    @InjectRepository(Sport)
    private readonly sportRepository: Repository<Sport>,
    @InjectRepository(Score)
    private readonly scoreRepository: Repository<Score>,
    private readonly httpService: HttpService,
    private readonly logger: Logger,
  ) {
    this.queryRuner = getConnection().createQueryRunner();
  }

  async truncate() {
    this.logger.debug('Clear all tables ...');
    await getConnection().synchronize(true);
  }

  async seed() {
    await this.truncate();
    this.logger.debug('Run seeds');
    const users = await this.seedUser();
    this.logger.debug('Successfuly completed seeding users...');
    const sports = await this.seedSport();
    this.logger.debug('Successfuly completed seeding sport...');
    const events = await this.seedEvent();
    this.logger.debug('Successfuly completed seeding events...');
    const score = await this.seedScore();
    this.logger.debug('Successfuly completed seeding scores...');
  }

  async seedUser() {
    const users = [];
    this.logger.debug('Clear users tables ...');
    const user = new User();
    user.email = `admin@olympicgames.com`;
    user.name = 'admin';
    user.password = 'olympicgames2024+!';
    await user.save();
    users.push(user);
    return users;
  }

  private async seedSport() {
    const sportsData = await this.httpService
      .get('https://parseapi.back4app.com/classes/Listsportstokyolympic', {
        headers: {
          'X-Parse-Application-Id': 'Dwco6bapxxssPbLehcLJ244hWjXYhrHPGdyONZNm', // This is the fake app's application id
          'X-Parse-Master-Key': 'PfOgFvxS79kRM1v7guxCyXLw93uSk348Q376mSjs', // This is the fake app's readonly master key
        },
      })
      .toPromise();
    const sports = sportsData.data.results
      .map(async (e) => {
        const sportFromDB = await this.sportRepository.findOne({
          where: { slug: slugify(e.Sport) },
        });
        if (sportFromDB === undefined) {
          const sport = new Sport();
          sport.name = e.Sport;
          sport.slug = slugify(e.Sport);
          await sport.save();
          return sport;
        }
      })
      .filter((e) => e);

    return sports;
  }

  private async seedEvent() {
    const eventData = await this.httpService
      .get('https://parseapi.back4app.com/classes/Listsportstokyolympic', {
        headers: {
          'X-Parse-Application-Id': 'Dwco6bapxxssPbLehcLJ244hWjXYhrHPGdyONZNm', // This is the fake app's application id
          'X-Parse-Master-Key': 'PfOgFvxS79kRM1v7guxCyXLw93uSk348Q376mSjs', // This is the fake app's readonly master key
        },
      })
      .toPromise();
    const events = eventData.data.results
      .map(async (e) => {
        const sport = await this.sportRepository.findOne({
          where: { slug: slugify(e.Sport) },
        });
        if (sport) {
          const event = new EventCategory();
          event.name = e.Programme;
          event.slug = slugify(e.Programme);
          event.type = e.Programme.includes('(Men/Women)')
            ? Type.MenWomen
            : e.Programme.includes('(Men)')
            ? Type.Men
            : e.Programme.includes('(Women)')
            ? Type.Women
            : Type.Unknow;
          event.sport = sport;
          await event.save();
          return event;
        }
      })
      .filter((e) => e);

    return [];
  }

  private async seedScore() {}
}
