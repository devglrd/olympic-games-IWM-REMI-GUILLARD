import { Module } from '@nestjs/common';
import { SportService } from './sport.service';
import { SportController } from './sport.controller';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Sport } from './sport.entity';

@Module({
  imports: [TypeOrmModule.forFeature([Sport])],
  providers: [SportService],
  controllers: [SportController],
  exports: [SportService],
})
export class SportModule {}
