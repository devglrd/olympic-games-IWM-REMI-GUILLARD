import { Module } from '@nestjs/common';
import { EventService } from './event.service';
import { EventController } from './event.controller';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Event } from './event.entity';
import { EventCategory } from './eventCategory.entity';
import { SportModule, SportService } from '../sport';
import {EventCategoryController} from "./eventCategory.controller";
import {CategoryService} from "./category.service";

@Module({
  imports: [TypeOrmModule.forFeature([Event, EventCategory])],
  exports: [EventService, CategoryService],
  providers: [EventService, CategoryService],
  controllers: [EventController, EventCategoryController],
})
export class EventModule {}
