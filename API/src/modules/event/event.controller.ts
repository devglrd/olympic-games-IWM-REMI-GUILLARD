import { Controller, Get, Res } from '@nestjs/common';
import { ApiTags } from '@nestjs/swagger';
import { EventService } from './event.service';
import { EventResssource } from './sport-resssource';

@ApiTags('events')
@Controller('event')
export class EventController {
  constructor(private readonly eventService: EventService) {}

  @Get()
  async index(@Res() res) {
    const events = await this.eventService.index();
    return res.send({
      data: EventResssource.collection(events),
    });
  }
}
