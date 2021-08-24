import {Controller, Delete, Get, Post, Put, Req, Res} from '@nestjs/common';
import { ApiTags } from '@nestjs/swagger';
import { ScoreService } from './score.service';
import { ScoreResssource } from './score-resssource';
import {EventResssource} from "../event/sport-resssource";

@ApiTags('scores')
@Controller('scores')
export class ScoreController {
  constructor(private readonly scoreService: ScoreService) {}

  @Get()
  async index(@Res() res) {
    const sports = await this.scoreService.index();
    return res.send({
      data: ScoreResssource.collection(sports),
    });
  }

  @Post()
  async store(@Req() req, @Res() res) {
    // const sport = await this.sportService.find(req.sport)
    const event = await this.scoreService.store(req.body);
    return res.send({
      data: ScoreResssource.toArray(event),
    });
  }

  @Put(':id')
  async update(@Req() req, @Res() res) {
    // const sport = await this.sportService.find(req.sport)
    const event = await this.scoreService.update(req.body, req.params.id);
    return res.send({
      data: ScoreResssource.toArray(event),
    });
  }

  @Put('/validate/:id')
  async validate(@Req() req, @Res() res) {
    // const sport = await this.sportService.find(req.sport)
    const event = await this.scoreService.validate(req.params.id);
    return res.send({
      data: ScoreResssource.toArray(event),
    });
  }

  @Delete(':id')
  async delete(@Req() req, @Res() res) {
    // const sport = await this.sportService.find(req.sport)
    const event = await this.scoreService.delete(req.params.id);
    return res.send({
      data: 'Success',
    });
  }
}
