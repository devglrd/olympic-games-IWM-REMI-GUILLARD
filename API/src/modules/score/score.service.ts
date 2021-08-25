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
        return this.scoreRepository.find({where : {validate: 1}});
    }

    async hasValidateIndex(){
        return this.scoreRepository.find({where : {validate: 0}});
    }

    async store(data) {
        const score = new Score();
        const event = await Event.findOne({where: {id: data.event}});
        score.type = data.type;
        score.score = data.score;
        score.unit = data.unit;
        score.validate = 0;
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
        score.validate = 0;
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
        score.validate = 1;
        return await score.save();
    }


}
