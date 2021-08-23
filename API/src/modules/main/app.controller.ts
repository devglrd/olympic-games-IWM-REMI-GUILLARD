import { Get, Controller, UseGuards, Res } from '@nestjs/common';
import { AuthGuard } from '@nestjs/passport';
import {ApiBearerAuth, ApiTags} from '@nestjs/swagger';
import { AppService } from './app.service';
import { Response } from 'express';

@ApiTags('api')
@Controller()
export class AppController {
    constructor(private readonly appService: AppService) {}

    @Get()
    root(@Res() res: Response): Response {
        return res.send({
            message: 'Welcome to Olympic Game API',
        });
    }
}
