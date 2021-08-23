import { Module } from '@nestjs/common';
import { SportService } from './sport.service';
import { SportController } from './sport.controller';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Sport } from './sport.entity';
import {AuthModule, AuthService} from "../auth";

@Module({
  imports: [TypeOrmModule.forFeature([Sport]), AuthModule],
  providers: [SportService],
  controllers: [SportController],
  exports: [SportService],
})
export class SportModule {}
