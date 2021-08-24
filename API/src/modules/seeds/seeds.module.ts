import { HttpModule, Logger, Module } from '@nestjs/common';
import { SeedsController } from './seeds.controller';
import { SeedsService } from './seeds.service';
import { User } from '../user';
import { TypeOrmModule } from '@nestjs/typeorm';
import { ConfigModule, ConfigService } from '../config';
import { Sport } from '../sport';
import { Score } from '../score';
import { Event } from '../event';
import { EventCategory } from '../event/eventCategory.entity';

@Module({
  imports: [
    HttpModule,
    ConfigModule,
    TypeOrmModule.forFeature([User, Sport, Score, Event, EventCategory]),
  ],
  controllers: [SeedsController],
  providers: [SeedsService, Logger],
})
export class SeedsModule {}
