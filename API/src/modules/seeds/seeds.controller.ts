import {
  Controller,
  Get,
  Req,
  Res,
  UnauthorizedException,
} from '@nestjs/common';
import { Response, Request } from 'express';
import { ApiTags } from '@nestjs/swagger';
import { ConfigService } from '../config';
import { SeedsService } from './seeds.service';

@ApiTags('seeds')
@Controller('seeds')
export class SeedsController {
  constructor(
    private seedsService: SeedsService,
    private configService: ConfigService,
  ) {}

  @Get()
  async seeds(@Res() res: Response, @Req() req: Request) {
    const { token } = req.query;
    console.log(token);
    if (token !== this.configService.get('SEEDER_TOKEN')) {
      throw new UnauthorizedException('Wrong Token combination!');
    }
    await this.seedsService.seed();
    return res.send({
      message: 'Database Seeding',
    });
  }
}
