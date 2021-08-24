import { Injectable } from '@nestjs/common';
import { Event } from './event.entity';

@Injectable()
export class EventResssource {
  static toArray(user: Event) {
    return {
      id: user.id,
      name: user.name,
      location: user.location,
      content: user.content,
      startAt: user.startAt,
      time: user.time,
      sport: user.sport,
      scores: user.scores,
      category: user.category,
    };
  }

  static collection(users: Event[]) {
    return users.map((user: Event) => {
      return {
        id: user.id,
        name: user.name,
        location: user.location,
        content: user.content,
        startAt: user.startAt,
        time: user.time,
        sport: user.sport,
        scores: user.scores,
        category: user.category,
      };
    });
  }
}
