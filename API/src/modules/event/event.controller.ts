import {
  Controller,
  Delete,
  Get,
  Post,
  Put,
  Req,
  Res,
  UseGuards,
} from '@nestjs/common';
import { ApiBearerAuth, ApiResponse, ApiTags } from '@nestjs/swagger';
import { EventService } from './event.service';
import { EventResssource } from './sport-resssource';
import { AuthGuard } from '@nestjs/passport';
import { SportResssource } from '../sport/sport-resssource';
import { SportService } from '../sport';

@ApiTags('events')
@Controller('events')
export class EventController {
  constructor(private readonly eventService: EventService) {}

  @Get()
  async index(@Res() res) {
    const events = await this.eventService.index();
    return res.send({
      data: EventResssource.collection(events),
    });
  }

  @Post()
  async store(@Req() req, @Res() res) {
    // const sport = await this.sportService.find(req.sport)
    const event = await this.eventService.store(req.body);
    return res.send({
      data: EventResssource.toArray(event),
    });
  }

  @Put(':id')
  async update(@Req() req, @Res() res) {
    // const sport = await this.sportService.find(req.sport)
    const event = await this.eventService.update(req.body, req.params.id);
    return res.send({
      data: EventResssource.toArray(event),
    });
  }

  @Delete(':id')
  async delete(@Req() req, @Res() res) {
    // const sport = await this.sportService.find(req.sport)
    const event = await this.eventService.delete(req.params.id);
    return res.send({
      data: 'Success',
    });
  }
}
