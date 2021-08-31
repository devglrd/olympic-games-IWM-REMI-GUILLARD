import {
  Entity,
  Column,
  PrimaryGeneratedColumn,
  BaseEntity,
  OneToOne,
  JoinColumn,
  CreateDateColumn,
  UpdateDateColumn,
  ManyToOne,
  OneToMany,
} from 'typeorm';
import { Event } from '../event';
import { File } from '../file';
import { EventCategory } from '../event/eventCategory.entity';
import { GlobalScopes } from 'typeorm-global-scopes';

@GlobalScopes<Sport>([(qb, alias) => qb.andWhere(`${alias}.delete = 0`)])
@Entity({
  name: 'sports',
})
export class Sport extends BaseEntity {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({ length: 255 })
  name: string;

  @Column({ length: 255, unique: true })
  slug: string;

  @Column({ length: 1000, nullable: true })
  content: string;

  @Column({ default: false })
  delete: boolean;

  @OneToOne((type) => File, { onDelete: 'CASCADE' })
  @JoinColumn({ name: 'fk_file_id' })
  @Column({ nullable: true })
  file: number;

  @OneToMany((type) => Event, (event) => event.sport, {
    eager: true,
    onDelete: 'CASCADE',
  })
  event: Event[];

  @OneToMany((type) => EventCategory, (event) => event.sport, {
    eager: true,
    onDelete: 'CASCADE',
  })
  cat: EventCategory[];

  @CreateDateColumn()
  createdAt: Date;

  @UpdateDateColumn()
  updatedAt: Date;
}

export class SportFillableFields {
  name: string;
  slug: string;
  content: string;
  file: number;
  updatedAt: Date;
  createdAt: Date;
}
