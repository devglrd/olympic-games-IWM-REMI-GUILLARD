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
import { ScoreService } from './score.service';
import { ScoreResssource } from './score-resssource';
import { AuthGuard } from '@nestjs/passport';
import { Score } from './score.entity';
import { MailerService } from '@nestjs-modules/mailer';

@ApiTags('scores')
@Controller('scores')
export class ScoreController {
  constructor(
    private readonly scoreService: ScoreService,
    private mailerService: MailerService,
  ) {}

  @Get()
  async index(@Res() res) {
    const scores = await this.scoreService.index();

    return res.send({
      data: ScoreResssource.collection(scores),
    });
  }


  @Get('/admin')
  async indexAdmin(@Res() res) {
    const scores = await this.scoreService.indexAll();

    return res.send({
      data: ScoreResssource.collection(scores),
    });
  }


  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Get('/hasValidate')
  async indexValidate(@Res() res) {
    console.log('la');
    const score = await this.scoreService.hasValidateIndex();
    console.log(score);
    return res.send({
      data: score,
    });
  }


  @Get(":id")
  async show(@Req() req, @Res() res) {
    const score = await this.scoreService.findOne(req.params.id);

    return res.send({
      data: ScoreResssource.toArray(score),
    });
  }



  @Post()
  async store(@Req() req, @Res() res) {
    const score = await this.scoreService.store(req.body);
    if (!score) {
      return res.send({
        message: 'Error not same day',
      });
    }
    return res.send({
      data: score,
    });
  }


  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Post('/admin')
  async storeForAdmin(@Req() req, @Res() res) {
    const score = await this.scoreService.store(req.body);
    return res.send({
      data: score,
    });
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Put(':id')
  async update(@Req() req, @Res() res) {
    const score = await this.scoreService.update(req.body, req.params.id);
    return res.send({
      data: score,
    });
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Put('/validate/:id')
  async validate(@Req() req, @Res() res) {

    const score = await Score.findOne({ where: { id: req.params.id } });
    score.validate = 1;
    await score.save();

    this.mailerService
      .sendMail({
        to: score.email,
        from: 'olympics@gmail.com',
        subject: 'Votre score a été accepter',
        html:
          '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\n' +
          '        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n' +
          '<html xmlns="http://www.w3.org/1999/xhtml">\n' +
          '<head>\n' +
          '    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>\n' +
          '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>\n' +
          '    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">\n' +
          '</head>\n' +
          '<body>\n' +
          '<style>\n' +
          '    body, body *:not(html):not(style):not(br):not(tr):not(code) {\n' +
          "        font-family: 'Raleway', sans-serif;\n" +
          '        box-sizing: border-box;\n' +
          '    }\n' +
          '    @media only screen and (max-width: 600px) {\n' +
          '        .inner-body {\n' +
          '            width: 100% !important;\n' +
          '        }\n' +
          '        .footer {\n' +
          '            width: 100% !important;\n' +
          '        }\n' +
          '    }\n' +
          '    @media only screen and (max-width: 500px) {\n' +
          '        .button {\n' +
          '            width: 100% !important;\n' +
          '        }\n' +
          '    }\n' +
          '    .head-bandeau {\n' +
          '        width: 13%;\n' +
          '        height: 10px;\n' +
          '        background-color: yellow;\n' +
          '    }\n' +
          '    .first {\n' +
          '        background-color: #42254D;\n' +
          '    }\n' +
          '    .second {\n' +
          '        background-color: #4D3675;\n' +
          '    }\n' +
          '    .third {\n' +
          '        background-color: #6E2658;\n' +
          '    }\n' +
          '    .four {\n' +
          '        background-color: #A71F51;\n' +
          '    }\n' +
          '    .five {\n' +
          '        background-color: #D4214B;\n' +
          '    }\n' +
          '    .six {\n' +
          '        background-color: #E65020;\n' +
          '    }\n' +
          '    .seven {\n' +
          '        background-color: #FF9700;\n' +
          '    }\n' +
          '    .hei {\n' +
          '        background-color: #FFCD00;\n' +
          '    }\n' +
          '    body {\n' +
          '        margin: 0;\n' +
          '    }\n' +
          '    .heading {\n' +
          '        width: 70%;\n' +
          '        margin: 0 auto;\n' +
          '        display: flex;\n' +
          '        justify-content: space-between;\n' +
          '        align-content: center;\n' +
          '    }\n' +
          '    .be-u {\n' +
          '        color: #1B1624;\n' +
          '        /*font-family: "Codec Cold Logo";*/\n' +
          '        font-size: 40px;\n' +
          '        font-weight: bold;\n' +
          '        line-height: 52px;\n' +
          '    }\n' +
          '    .date {\n' +
          '        color: #1B1624;\n' +
          '        /*font-family: Arial;*/\n' +
          '        font-size: 14px;\n' +
          '        line-height: 16px;\n' +
          '        text-align: right;\n' +
          '        display: flex;\n' +
          '        align-items: center;\n' +
          '    }\n' +
          '    .body {\n' +
          '        width: 100%;\n' +
          '    }\n' +
          '    .inner-body {\n' +
          '        margin: 0 auto;\n' +
          '        width: 70%;\n' +
          '        margin-bottom: 30px;\n' +
          '    }\n' +
          '    .footer__rs {\n' +
          '        display: flex;\n' +
          '        justify-content: center;\n' +
          '    }\n' +
          '    .footer__rs__container {\n' +
          '        display: inline-flex;\n' +
          '        align-items: center;\n' +
          '        justify-content: space-between;\n' +
          '    }\n' +
          '</style>\n' +
          '\n' +
          '<table class="wrapper" width="100%" cellpadding="0" cellspacing="0">\n' +
          '    <tr>\n' +
          '        <td align="center">\n' +
          '            <table class="content" width="100%" cellpadding="0" cellspacing="0">\n' +
          '                <tr style="width: 100%;display: flex;align-items: center;justify-content: flex-start;">\n' +
          '                    <td class="head-bandeau first">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau second">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau third">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau four">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau five">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau six">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau seven">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau hei">\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '\n' +
          '                <tr style="text-align: center;">\n' +
          '                    <td class="heading">\n' +
          '                        <h3 class="be-u">Olympics Game</h3>\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '                <tr style="background-color: rgba(226, 226, 226, 0.38);">\n' +
          '                    <td class="body" cellpadding="0" cellspacing="0"\n' +
          '                        style="border-top: 1px solid #E2E2E2;border-bottom: 1px solid #E2E2E2;">\n' +
          '                        <table class="inner-body" cellpadding="0" cellspacing="0">\n' +
          '                            <tr style="margin-bottom: 40px">\n' +
          '                                <td class="content-cell"\n' +
          '                                    style="text-align:left;color: #324e6d;">\n' +
          '                                    <div style="font-size: 16px; padding-top:30px;display: inline-block">\n' +
          '                                        <span style="color: #1B1624;\tfont-family: \'Roboto\', sans-serif;;\tfont-size: 24px;\tfont-weight: bold;\tline-height: 28px;">\n' +
          '                                       Well done the score you submitted has been accepted!\n' +
          '                                        </span>\n' +
          '                                    </div>\n' +
          '                                </td>\n' +
          '                            </tr>\n' +
          '                        </table>\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '                <tr>\n' +
          '                    <td class="heading" style="margin-top: 30px">\n' +
          '                        <span style="color: #1B1624;\tfont-family: \'Roboto\', sans-serif;\tfont-size: 14px;\tline-height: 18px;">Olympics game</span>\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '            </table>\n' +
          '        </td>\n' +
          '    </tr>\n' +
          '</table>\n' +
          '</body>\n' +
          '</html>\n',
        context: {},
      })
      .then((e) => {
        return res.send({
          data: score,
        });
      })
      .catch((err) => {});
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Put('/refuse/:id')
  async refuse(@Req() req, @Res() res) {
    const score = await Score.findOne({ where: { id: req.params.id } });
    score.validate = -1;
    await score.save();

    this.mailerService
      .sendMail({
        to: score.email,
        from: 'admin@olympics.com',
        subject: 'Votre score a été refusé',
        html:
          '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\n' +
          '        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n' +
          '<html xmlns="http://www.w3.org/1999/xhtml">\n' +
          '<head>\n' +
          '    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>\n' +
          '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>\n' +
          '    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">\n' +
          '</head>\n' +
          '<body>\n' +
          '<style>\n' +
          '    body, body *:not(html):not(style):not(br):not(tr):not(code) {\n' +
          "        font-family: 'Raleway', sans-serif;\n" +
          '        box-sizing: border-box;\n' +
          '    }\n' +
          '    @media only screen and (max-width: 600px) {\n' +
          '        .inner-body {\n' +
          '            width: 100% !important;\n' +
          '        }\n' +
          '        .footer {\n' +
          '            width: 100% !important;\n' +
          '        }\n' +
          '    }\n' +
          '    @media only screen and (max-width: 500px) {\n' +
          '        .button {\n' +
          '            width: 100% !important;\n' +
          '        }\n' +
          '    }\n' +
          '    .head-bandeau {\n' +
          '        width: 13%;\n' +
          '        height: 10px;\n' +
          '        background-color: yellow;\n' +
          '    }\n' +
          '    .first {\n' +
          '        background-color: #42254D;\n' +
          '    }\n' +
          '    .second {\n' +
          '        background-color: #4D3675;\n' +
          '    }\n' +
          '    .third {\n' +
          '        background-color: #6E2658;\n' +
          '    }\n' +
          '    .four {\n' +
          '        background-color: #A71F51;\n' +
          '    }\n' +
          '    .five {\n' +
          '        background-color: #D4214B;\n' +
          '    }\n' +
          '    .six {\n' +
          '        background-color: #E65020;\n' +
          '    }\n' +
          '    .seven {\n' +
          '        background-color: #FF9700;\n' +
          '    }\n' +
          '    .hei {\n' +
          '        background-color: #FFCD00;\n' +
          '    }\n' +
          '    body {\n' +
          '        margin: 0;\n' +
          '    }\n' +
          '    .heading {\n' +
          '        width: 70%;\n' +
          '        margin: 0 auto;\n' +
          '        display: flex;\n' +
          '        justify-content: space-between;\n' +
          '        align-content: center;\n' +
          '    }\n' +
          '    .be-u {\n' +
          '        color: #1B1624;\n' +
          '        /*font-family: "Codec Cold Logo";*/\n' +
          '        font-size: 40px;\n' +
          '        font-weight: bold;\n' +
          '        line-height: 52px;\n' +
          '    }\n' +
          '    .date {\n' +
          '        color: #1B1624;\n' +
          '        /*font-family: Arial;*/\n' +
          '        font-size: 14px;\n' +
          '        line-height: 16px;\n' +
          '        text-align: right;\n' +
          '        display: flex;\n' +
          '        align-items: center;\n' +
          '    }\n' +
          '    .body {\n' +
          '        width: 100%;\n' +
          '    }\n' +
          '    .inner-body {\n' +
          '        margin: 0 auto;\n' +
          '        width: 70%;\n' +
          '        margin-bottom: 30px;\n' +
          '    }\n' +
          '    .footer__rs {\n' +
          '        display: flex;\n' +
          '        justify-content: center;\n' +
          '    }\n' +
          '    .footer__rs__container {\n' +
          '        display: inline-flex;\n' +
          '        align-items: center;\n' +
          '        justify-content: space-between;\n' +
          '    }\n' +
          '</style>\n' +
          '\n' +
          '<table class="wrapper" width="100%" cellpadding="0" cellspacing="0">\n' +
          '    <tr>\n' +
          '        <td align="center">\n' +
          '            <table class="content" width="100%" cellpadding="0" cellspacing="0">\n' +
          '                <tr style="width: 100%;display: flex;align-items: center;justify-content: flex-start;">\n' +
          '                    <td class="head-bandeau first">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau second">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau third">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau four">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau five">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau six">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau seven">\n' +
          '                    </td>\n' +
          '                    <td class="head-bandeau hei">\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '\n' +
          '                <tr style="text-align: center;">\n' +
          '                    <td class="heading">\n' +
          '                        <h3 class="be-u">Olympics Game</h3>\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '                <tr style="background-color: rgba(226, 226, 226, 0.38);">\n' +
          '                    <td class="body" cellpadding="0" cellspacing="0"\n' +
          '                        style="border-top: 1px solid #E2E2E2;border-bottom: 1px solid #E2E2E2;">\n' +
          '                        <table class="inner-body" cellpadding="0" cellspacing="0">\n' +
          '                            <tr style="margin-bottom: 40px">\n' +
          '                                <td class="content-cell"\n' +
          '                                    style="text-align:left;color: #324e6d;">\n' +
          '                                    <div style="font-size: 16px; padding-top:30px;display: inline-block">\n' +
          '                                        <span style="color: #1B1624;\tfont-family: \'Roboto\', sans-serif;;\tfont-size: 24px;\tfont-weight: bold;\tline-height: 28px;">\n' +
          '                                       Unfortunately, the score you submitted was not accepted! \n' +
          '                                        </span>\n' +
          '                                    </div>\n' +
          '                                </td>\n' +
          '                            </tr>\n' +
          '                        </table>\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '                <tr>\n' +
          '                    <td class="heading" style="margin-top: 30px">\n' +
          '                        <span style="color: #1B1624;\tfont-family: \'Roboto\', sans-serif;\tfont-size: 14px;\tline-height: 18px;">Olympics game</span>\n' +
          '                    </td>\n' +
          '                </tr>\n' +
          '            </table>\n' +
          '        </td>\n' +
          '    </tr>\n' +
          '</table>\n' +
          '</body>\n' +
          '</html>\n',
        context: {},
      })
      .then(() => {
        return res.send({
          data: score,
        });
      })
      .catch((err) => {});
  }

  @ApiBearerAuth()
  @UseGuards(AuthGuard())
  @ApiResponse({ status: 200, description: 'Successful Response' })
  @ApiResponse({ status: 401, description: 'Unauthorized' })
  @Delete(':id')
  async delete(@Req() req, @Res() res) {
    await this.scoreService.delete(req.params.id);
    return res.send({
      data: 'Success',
    });
  }
}
