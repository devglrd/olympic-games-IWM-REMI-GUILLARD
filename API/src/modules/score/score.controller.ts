import {Controller, Delete, Get, Post, Put, Req, Res, UseGuards} from '@nestjs/common';
import {ApiBearerAuth, ApiResponse, ApiTags} from '@nestjs/swagger';
import {ScoreService} from './score.service';
import {ScoreResssource} from './score-resssource';
import {AuthGuard} from "@nestjs/passport";
import {Score} from "./score.entity";

@ApiTags('scores')
@Controller('scores')
export class ScoreController {
    constructor(private readonly scoreService: ScoreService) {
    }

    @Get()
    async index(@Res() res) {
        const sports = await this.scoreService.index();
        return res.send({
            data: ScoreResssource.collection(sports),
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Get('/hasValidate')
    async indexValidate(@Res() res) {
        const sports = await this.scoreService.hasValidateIndex();
        console.log(sports);
        return res.send({
            data: sports,
        });
    }

    @Post()
    async store(@Req() req, @Res() res) {
        // const sport = await this.sportService.find(req.sport)
        const event = await this.scoreService.store(req.body);
        return res.send({
            data: event,
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Put(':id')
    async update(@Req() req, @Res() res) {
        // const sport = await this.sportService.find(req.sport)
        const event = await this.scoreService.update(req.body, req.params.id);
        return res.send({
            data: ScoreResssource.toArray(event),
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Put('/validate/:id')
    async validate(@Req() req, @Res() res) {
        // const sport = await this.sportService.find(req.sport)
        // const score = await this.scoreService.validate(req.params.id);
        const score = await Score.findOne({where: {id: req.params.id}});
        score.validate = true;
        await score.save();
        setTimeout(() => {

        }, 500)

        console.log(score, '---t');
        return res.send({
            data: score,
        });
    }

    @ApiBearerAuth()
    @UseGuards(AuthGuard())
    @ApiResponse({status: 200, description: 'Successful Response'})
    @ApiResponse({status: 401, description: 'Unauthorized'})
    @Delete(':id')
    async delete(@Req() req, @Res() res) {
        // const sport = await this.sportService.find(req.sport)
        const event = await this.scoreService.delete(req.params.id);
        return res.send({
            data: 'Success',
        });
    }
}
