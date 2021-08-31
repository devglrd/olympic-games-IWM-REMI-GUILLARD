import { Injectable } from '@nestjs/common';
import { Event } from './event.entity';
import { ScoreResssource } from '../score/score-resssource';

@Injectable()
export class EventResssource {
  static toArray(event: Event) {
    return {
      id: event.id,
      name: event.name,
      location: event.location,
      content: event.content,
      startAt: event.startAt,
      time: event.time,
      sport: event.sport,
      scores: ScoreResssource.collection(event.scores),
      category: event.category,
    };
  }

  static collection(events: Event[]) {
    return events
      ? events.map((event: Event) => {
          return {
            id: event.id,
            name: event.name,
            location: event.location,
            content: event.content,
            startAt: event.startAt,
            time: event.time,
            sport: event.sport,
            scores: ScoreResssource.collection(event.scores),
            category: event.category,
          };
        })
      : [];
  }
}
