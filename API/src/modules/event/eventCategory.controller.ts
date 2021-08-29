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
import {EventService} from './event.service';
import {AuthGuard} from '@nestjs/passport';
import {SportResssource} from '../sport/sport-resssource';
import {SportService} from '../sport';
import {EventResssource} from "./event-resssource";
import {CategoryService} from "./category.service";
import {EventCategoryResssource} from "./cat-resssource";

@ApiTags('category')
@Controller('category')
export class EventCategoryController {
    constructor(private readonly eventService: EventService, private readonly catService: CategoryService) {
    }

    @Get()
    async index(@Req() req, @Res() res) {
        if(req.query.filter && req.query.filterType  === "sport"){
            console.log('ic');
            const events = await this.catService.filterSport(req.query.filter)
            return res.send({
                data: EventCategoryResssource.collection(events),
            });
        }
        const events = await this.catService.index();
        return res.send({
            data: EventCategoryResssource.collection(events),
        });
    }

    @Get(':id')
    async show(@Req() req, @Res() res) {
        const event = await this.catService.find(req.params.id);
        return res.send({
            data: EventCategoryResssource.toArray(event),
        });
    }


    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Post()
    async store(@Req() req, @Res() res) {
        // const sport = await this.sportService.find(req.sport)
        const event = await this.catService.store(req.body);
        return res.send({
            data: EventCategoryResssource.toArray(event),
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Put(':id')
    async update(@Req() req, @Res() res) {
        // const sport = await this.sportService.find(req.sport)
        const event = await this.catService.update(req.body, req.params.id);
        return res.send({
            data: EventCategoryResssource.toArray(event),
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Delete(':id')
    async delete(@Req() req, @Res() res) {
        // const sport = await this.sportService.find(req.sport)
        const event = await this.catService.delete(req.params.id);
        return res.send({
            data: 'Success',
        });
    }
}
