import {Injectable} from '@nestjs/common';
import {InjectRepository} from '@nestjs/typeorm';
import {Repository} from 'typeorm';
import {Score} from './score.entity';
import {Event} from '../event';

@Injectable()
export class ScoreService {
    constructor(
        @InjectRepository(Score)
        private readonly scoreRepository: Repository<Score>,
    ) {
    }

    async index() {
        return this.scoreRepository.find({where : {validate: true}});
    }

    async store(data) {
        const score = new Score();
        const event = await Event.findOne({where: {id: data.event}});
        score.type = data.type;
        score.score = data.score;
        score.unit = data.unit;
        score.validate = false;
        score.email = data.email;
        score.event = event;
        return await score.save();
    }

    async update(data, id) {
        const score = await Score.findOne({where: id});
        const event = await Event.findOne({where: {id: data.event}});
        score.type = data.type;
        score.score = data.score;
        score.unit = data.unit;
        score.validate = false;
        score.email = data.email;
        score.event = event;
        return await score.save();
    }

    async delete(id) {
        const score = await Score.findOne({where: id});
        return await this.scoreRepository.delete(score);
    }

    async validate(id) {
        const score = await Score.findOne({where: id});
        score.validate = true;
        return await score.save();
    }


}
