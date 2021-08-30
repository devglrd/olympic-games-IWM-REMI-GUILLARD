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
import {ApiBearerAuth, ApiResponse, ApiTags} from '@nestjs/swagger';
import {SportService} from './sport.service';
import {SportResssource} from './sport-resssource';
import {AuthGuard} from '@nestjs/passport';
import {EventResssource} from "../event/event-resssource";
import {Sport} from "./sport.entity";

@ApiTags('sports')
@Controller('sports')
export class SportController {
    constructor(private readonly sportService: SportService) {
    }

    @Get()
    async index(@Req() req, @Res() res) {
        if (req.query.filterType && req.query.filterType === "events") {
            const sports = await this.sportService.filterSport(req.query.filter)
            const al = await Promise.all(sports.map(e => Sport.findOne({where: {id: e.id}})));
            res.send({
                data: SportResssource.collection(al),
            });
        }
        const sports = await this.sportService.index();
        return res.send({
            data: SportResssource.collection(sports),
        });
    }

    @Get(':id')
    async show(@Req() req, @Res() res) {
        console.log(req.params.id);
        const sport = await this.sportService.findOne(req.params.id);
        return res.send({
            data: SportResssource.toArray(sport),
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Post()
    async store(@Req() req, @Res() res) {
        const sport = await this.sportService.store(req.body);
        return res.send({
            data: SportResssource.toArray(sport),
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Put(':id')
    async update(@Req() req, @Res() res) {
        const sport = await this.sportService.update(req.body, req.params.id);
        return res.send({
            data: SportResssource.toArray(sport),
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Delete(':slug')
    async delete(@Req() req, @Res() res) {
        const sport = await this.sportService.delete(req.params.slug);
        return res.send({
            message: 'Success',
        });
    }
}
