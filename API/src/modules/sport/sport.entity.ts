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

  @OneToOne((type) => File)
  @JoinColumn({ name: 'fk_file_id' })
  @Column({ nullable: true })
  file: number;

  @OneToMany((type) => Event, (event) => event.sport, {eager: true})
  event: Event[];

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
