import { Exclude } from 'class-transformer';
import { Entity, Column, PrimaryGeneratedColumn, BaseEntity } from 'typeorm';
import {PasswordTransformer} from "./password.transformer";


@Entity({
    name: 'users',
})
export class User extends BaseEntity {
    @PrimaryGeneratedColumn()
    id: number;

    @Column({ length: 255 })
    name: string;

    @Column({ length: 255 })
    email: string;

    @Column({
        name: 'password',
        length: 255,
        transformer: new PasswordTransformer(),
    })
    @Exclude()
    password: string;
}

export class UserFillableFields {
    email: string;
    firstName: string;
    lastName: string;
    password: string;
}
