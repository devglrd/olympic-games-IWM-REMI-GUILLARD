import {Exclude} from 'class-transformer';
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
import {Sport} from '../sport';
import {Score} from '../score';
import {Event} from './event.entity';

export enum Type {
    Men = 'Men',
    Women = 'Women',
    MenWomen = 'MenWomen',
    Unknow = 'unknow',
}

import {GlobalScopes} from "typeorm-global-scopes";

@GlobalScopes<EventCategory>([
    (qb, alias) => qb.andWhere(`${alias}.delete = 0`)
])
@Entity({
    name: 'events_category',
})
export class EventCategory extends BaseEntity {
    @PrimaryGeneratedColumn()
    id: number;

    @Column({length: 255})
    name: string;

    @Column('text', {nullable: true})
    type: Type | null;

    @Column({ default: false })
    delete: boolean;

    @Column({length: 255, unique: true})
    slug: string;

    @ManyToOne((type) => Sport, (sport) => sport.event)
    sport: Sport;

    @OneToMany((type) => Event, (event) => event.category, {onDelete: 'CASCADE',})
    events: Event[];
}

export class EventFillableFields {
    name: string;
}
