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
import { AuthGuard } from '@nestjs/passport';
import { SportResssource } from '../sport/sport-resssource';
import { SportService } from '../sport';
import { EventResssource } from './event-resssource';
import { EventCategoryResssource } from './cat-resssource';
import moment from 'moment';

@ApiTags('events')
@Controller('events')
export class EventController {
  constructor(private readonly eventService: EventService) {}

  @Get()
  async index(@Req() req, @Res() res) {
    if (req.query.filter && req.query.filterType === 'sport') {
      const events = await this.eventService.filterSport(req.query.filter);

      return res.send({
        data: EventResssource.collection(
          events.filter((e) => {
            const date = e.startAt.split('/');
            const validDate = date[1] + '-' + date[0] + '-' + date[2];
            return moment().isSame(moment(new Date(validDate)), 'day');
          }),
        ),
      });
    }
    const events = await this.eventService.index();
    return res.send({
      data: EventResssource.collection(events),
    });
  }

  @Get(':id')
  async show(@Req() req, @Res() res) {
    const event = await this.eventService.find(req.params.id);
    return res.send({
      data: EventResssource.toArray(event),
    });
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Post()
  async store(@Req() req, @Res() res) {
    const event = await this.eventService.store(req.body);
    return res.send({
      data: EventResssource.toArray(event),
    });
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Put(':id')
  async update(@Req() req, @Res() res) {
    const event = await this.eventService.update(req.body, req.params.id);
    return res.send({
      data: EventResssource.toArray(event),
    });
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Delete(':id')
  async delete(@Req() req, @Res() res) {
    await this.eventService.delete(req.params.id);
    return res.send({
      data: 'Success',
    });
  }
}
