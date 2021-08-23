import { Exclude } from 'class-transformer';
import {
  Entity,
  Column,
  PrimaryGeneratedColumn,
  BaseEntity,
  OneToOne,
  JoinColumn,
  ManyToOne,
  OneToMany,
} from 'typeorm';
import { Sport } from '../sport';
import { Score } from '../score';
import {EventCategory} from "./eventCategory.entity";

@Entity({
  name: 'events',
})
export class Event extends BaseEntity {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({ length: 255 })
  name: string;

  @Column({ length: 255 })
  location: string;

  @Column()
  startAt: Date;

  @Column({ length: 255 })
  time: string;

  @Column({ length: 255 })
  content: string;

  @ManyToOne((type) => Sport, (sport) => sport.event)
  sport: Sport;

  @OneToOne(type => EventCategory)
  @JoinColumn({ name: 'fk_event_category_id' })
  @Column()
  event: string;

  @OneToMany((type) => Score, (event) => event.event)
  scores: Score[];
}

export class EventFillableFields {
  name: string;
}
