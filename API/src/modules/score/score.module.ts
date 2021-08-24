import { Module } from '@nestjs/common';
import { ScoreController } from './score.controller';
import { ScoreService } from './score.service';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Score } from './score.entity';

@Module({
  imports: [TypeOrmModule.forFeature([Score])],
  exports: [ScoreService],
  controllers: [ScoreController],
  providers: [ScoreService],
})
export class ScoreModule {}
