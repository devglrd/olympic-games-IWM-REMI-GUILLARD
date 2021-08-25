import { Exclude } from 'class-transformer';
import {
  Entity,
  Column,
  PrimaryGeneratedColumn,
  BaseEntity,
  ManyToOne,
} from 'typeorm';
import { Sport } from '../sport';
import { Event } from '../event';

@Entity({
  name: 'scores',
})
export class Score extends BaseEntity {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({ length: 255 }) // EX : GOLD, SILVER, BRONZE
  type: string;

  @Column({ length: 255 }) // EX : 130, 70, 20
  score: string;

  @Column({ length: 255 }) // EX : MINUTE, LENGTH, SCORE
  unit: string;

  @Column()
  validate: number;


  @Column({ length: 255 })
  email: string;

  @ManyToOne((type) => Event, (event) => event.scores, )
  event: Event;
}

export class ScoreFillableFields {
  name: string;
}
