import { Controller, Get, Res } from '@nestjs/common';
import { ApiTags } from '@nestjs/swagger';
import { SportService } from './sport.service';
import { SportResssource } from './sport-resssource';

@ApiTags('sports')
@Controller('sports')
export class SportController {
  constructor(private readonly sportService: SportService) {}

  @Get()
  async index(@Res() res) {
    const sports = await this.sportService.index();
    return res.send({
      data: SportResssource.collection(sports),
    });
  }
}
