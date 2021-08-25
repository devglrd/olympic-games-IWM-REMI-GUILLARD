import {Injectable} from '@nestjs/common';
import {Score} from './score.entity';

@Injectable()
export class ScoreResssource {
    static toArray(score: Score) {
        if (score.validate) {

            return {
                id: score.id,
                type: score.type,
                score: score.score,
                unit: score.unit,
                validate: score.validate,
                email: score.email,
                event: score.event,
            };
        }
    }

    static collection(scores: Score[]) {
        return scores ? scores.map((score: Score) => {
            if (score.validate) {
                return {
                    id: score.id,
                    type: score.type,
                    score: score.score,
                    unit: score.unit,
                    validate: score.validate,
                    email: score.email,
                    event: score.event,
                };
            }
        }).filter(e => e !== undefined) : [];
    }
}
