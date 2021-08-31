import {Injectable} from '@nestjs/common';
import {InjectRepository} from '@nestjs/typeorm';
import {Repository} from 'typeorm';
import {Score} from './score.entity';
import {Event} from '../event';
import moment from 'moment';

@Injectable()
export class ScoreService {
    constructor(
        @InjectRepository(Score)
        private readonly scoreRepository: Repository<Score>,
    ) {
    }

    async index() {
        return this.scoreRepository.find({
            where: {validate: 1},
            order: {
                'id': 'DESC',
            },
            relations: ['event', 'event.sport'],
        });
    }


    async indexAll(){
        return this.scoreRepository.find({
            order: {
                'id': 'DESC',
            },
            relations: ['event', 'event.sport'],
        });
    }
    async findOne(id) {
        return this.scoreRepository.findOne({where: {id}, relations: ['event.sport', 'event']});

    }

    async hasValidateIndex() {
        return this.scoreRepository.find({  order: {
                'id': 'ASC',
            }, where: {validate: 0}});
    }

    async store(data) {
        const score = new Score();
        const event = await Event.findOne({where: {id: data.event}});
        const date = event.startAt.split('/');
        const validDate = date[1] + '-' + date[0] + '-' + date[2];
        if (!data.admin) {
            if (!moment().isSame(moment(new Date(validDate)), 'day')) {
                return false;
            }
        }
        score.type = data.type;
        score.score = data.score;
        score.unit = data.unit;
        score.validate = data.admin ? 1 : 0;
        score.email = data.admin ? 'olympic@gmail.com' : data.email;
        score.event = event;
        return await score.save();
    }

    async update(data, id) {
        const score = await Score.findOne({where: id});
        const event = await Event.findOne({where: {id: data.event}});
        score.type = data.type;
        score.score = data.score;
        score.unit = data.unit;
        score.validate = data.admin ? 1 : 0;
        score.email = data.admin ? 'olympic@gmail.com' : data.email;
        score.event = event;
        return await score.save();
    }

    async delete(id) {
        const score = await Score.findOne({where: id});
        score.delete = true;
        return await score.save();
    }

    async validate(id) {
        const score = await Score.findOne({where: id});
        score.validate = 1;
        return await score.save();
    }
}
