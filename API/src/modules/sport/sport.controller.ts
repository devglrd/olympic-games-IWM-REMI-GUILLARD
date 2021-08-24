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
import { SportService } from './sport.service';
import { SportResssource } from './sport-resssource';
import { AuthGuard } from '@nestjs/passport';

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

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Post()
  async store(@Req() req, @Res() res) {
    const sport = await this.sportService.store(req.body);
    return res.send({
      data: SportResssource.toArray(sport),
    });
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Put(':slug')
  async update(@Req() req, @Res() res) {
    const sport = await this.sportService.update(req.body, req.params.slug);
    return res.send({
      data: SportResssource.toArray(sport),
    });
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Delete(':slug')
  async delete(@Req() req, @Res() res) {
    const sport = await this.sportService.delete(req.params.slug);
    return res.send({
      message: 'Success',
    });
  }
}
