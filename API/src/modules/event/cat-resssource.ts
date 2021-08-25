import { Injectable } from '@nestjs/common';
import { Event } from './event.entity';
import {ScoreResssource} from "../score/score-resssource";
import {EventCategory} from "./eventCategory.entity";

@Injectable()
export class EventCategoryResssource {
  static toArray(user: EventCategory) {
    return {
      id: user.id,
      name: user.name,
      type: user.type,
      sport: user.sport,
    };
  }

  static collection(users: EventCategory[]) {
    return users.map((user: EventCategory) => {
      return {
        id: user.id,
        name: user.name,
        type: user.type,
        sport: user.sport,
      };
    });
  }
}
