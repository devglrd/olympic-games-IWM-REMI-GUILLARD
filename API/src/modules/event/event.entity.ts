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
import { EventCategory } from './eventCategory.entity';
import { Type } from 'class-transformer';

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

  @Type(() => Date)
  @Column('text')
  startAt: string;

  @Column({ length: 255 })
  time: string;

  @Column({ length: 255 })
  content: string;

  @Column({ default: false })
  delete: boolean;

  @ManyToOne((type) => Sport, (sport) => sport.event, )
  sport: Sport;

  @ManyToOne((type) => EventCategory, (cat) => cat.events, {eager: true, onDelete: 'CASCADE'})
  category: EventCategory;

  @OneToMany((type) => Score, (event) => event.event, {eager: true, onDelete: 'CASCADE',})
  scores: Score[];
}

export class EventFillableFields {
  name: string;
}
