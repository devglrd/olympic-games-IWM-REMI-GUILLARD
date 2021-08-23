import { Injectable } from '@nestjs/common';
import {Score} from "./score.entity";

@Injectable()
export class ScoreResssource {
  static toArray(user: Score) {
    return {
      id: user.id,
      type: user.type,
      score: user.score,
      unit: user.unit,
      validate: user.validate,
      email: user.email,
      event: user.event,
    };
  }

  static collection(users: Score[]) {
    return users.map((user: Score) => {
      return {
        id: user.id,
        type: user.type,
        score: user.score,
        unit: user.unit,
        validate: user.validate,
        email: user.email,
        event: user.event,
      };
    });
  }
}
