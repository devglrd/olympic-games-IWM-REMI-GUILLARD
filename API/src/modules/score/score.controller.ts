import { Controller, Get, Res } from '@nestjs/common';
import { ApiTags } from '@nestjs/swagger';
import { ScoreService } from './score.service';
import { ScoreResssource } from './score-resssource';

@ApiTags('scores')
@Controller('score')
export class ScoreController {
  constructor(private readonly scoreService: ScoreService) {}

  @Get()
  async index(@Res() res) {
    const sports = await this.scoreService.index();
    return res.send({
      data: ScoreResssource.collection(sports),
    });
  }
}
