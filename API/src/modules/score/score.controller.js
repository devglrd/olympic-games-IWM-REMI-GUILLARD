"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __param = (this && this.__param) || function (paramIndex, decorator) {
    return function (target, key) { decorator(target, key, paramIndex); }
};
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
exports.__esModule = true;
exports.ScoreController = void 0;
var common_1 = require("@nestjs/common");
var swagger_1 = require("@nestjs/swagger");
var score_resssource_1 = require("./score-resssource");
var passport_1 = require("@nestjs/passport");
var score_entity_1 = require("./score.entity");
var ScoreController = /** @class */ (function () {
    function ScoreController(scoreService, mailerService) {
        this.scoreService = scoreService;
        this.mailerService = mailerService;
    }
    ScoreController.prototype.index = function (res) {
        return __awaiter(this, void 0, void 0, function () {
            var score;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.scoreService.index()];
                    case 1:
                        score = _a.sent();
                        return [2 /*return*/, res.send({
                                data: score_resssource_1.ScoreResssource.collection(score)
                            })];
                }
            });
        });
    };
    ScoreController.prototype.indexValidate = function (res) {
        return __awaiter(this, void 0, void 0, function () {
            var sports;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.scoreService.hasValidateIndex()];
                    case 1:
                        sports = _a.sent();
                        console.log(sports);
                        return [2 /*return*/, res.send({
                                data: sports
                            })];
                }
            });
        });
    };
    ScoreController.prototype.store = function (req, res) {
        return __awaiter(this, void 0, void 0, function () {
            var event;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.scoreService.store(req.body)];
                    case 1:
                        event = _a.sent();
                        return [2 /*return*/, res.send({
                                data: event
                            })];
                }
            });
        });
    };
    ScoreController.prototype.update = function (req, res) {
        return __awaiter(this, void 0, void 0, function () {
            var event;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.scoreService.update(req.body, req.params.id)];
                    case 1:
                        event = _a.sent();
                        return [2 /*return*/, res.send({
                                data: score_resssource_1.ScoreResssource.toArray(event)
                            })];
                }
            });
        });
    };
    ScoreController.prototype.validate = function (req, res) {
        return __awaiter(this, void 0, void 0, function () {
            var score;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, score_entity_1.Score.findOne({ where: { id: req.params.id } })];
                    case 1:
                        score = _a.sent();
                        score.validate = 1;
                        return [4 /*yield*/, score.save()];
                    case 2:
                        _a.sent();
                        console.log(score.email);
                        this.mailerService.sendMail({
                            to: score.email,
                            from: 'glrd.remi@gmail.com',
                            subject: "Votre score a été accepter",
                            html: '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\n' +
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
                                '        font-family: \'Raleway\', sans-serif;\n' +
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
                                '                                       Score accepté !\n' +
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
                            context: {}
                        })
                            .then(function (e) {
                            console.log(e);
                            return res.send({
                                data: score
                            });
                        })["catch"](function (err) {
                        });
                        return [2 /*return*/];
                }
            });
        });
    };
    ScoreController.prototype.refuse = function (req, res) {
        return __awaiter(this, void 0, void 0, function () {
            var score;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, score_entity_1.Score.findOne({ where: { id: req.params.id } })];
                    case 1:
                        score = _a.sent();
                        score.validate = -1;
                        return [4 /*yield*/, score.save()];
                    case 2:
                        _a.sent();
                        this.mailerService.sendMail({
                            to: score.email,
                            from: 'admin@olympics.com',
                            subject: "Votre score a été refusé",
                            template: 'refuse',
                            context: {}
                        })
                            .then(function () {
                            return res.send({
                                data: score
                            });
                        })["catch"](function (err) {
                        });
                        return [2 /*return*/];
                }
            });
        });
    };
    ScoreController.prototype["delete"] = function (req, res) {
        return __awaiter(this, void 0, void 0, function () {
            var event;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.scoreService["delete"](req.params.id)];
                    case 1:
                        event = _a.sent();
                        return [2 /*return*/, res.send({
                                data: 'Success'
                            })];
                }
            });
        });
    };
    __decorate([
        common_1.Get(),
        __param(0, common_1.Res())
    ], ScoreController.prototype, "index");
    __decorate([
        swagger_1.ApiBearerAuth(),
        common_1.UseGuards(passport_1.AuthGuard()),
        swagger_1.ApiResponse({ status: 200, description: 'Successful Response' }),
        swagger_1.ApiResponse({ status: 401, description: 'Unauthorized' }),
        common_1.Get('/hasValidate'),
        __param(0, common_1.Res())
    ], ScoreController.prototype, "indexValidate");
    __decorate([
        common_1.Post(),
        __param(0, common_1.Req()),
        __param(1, common_1.Res())
    ], ScoreController.prototype, "store");
    __decorate([
        swagger_1.ApiBearerAuth(),
        common_1.UseGuards(passport_1.AuthGuard()),
        swagger_1.ApiResponse({ status: 200, description: 'Successful Response' }),
        swagger_1.ApiResponse({ status: 401, description: 'Unauthorized' }),
        common_1.Put(':id'),
        __param(0, common_1.Req()),
        __param(1, common_1.Res())
    ], ScoreController.prototype, "update");
    __decorate([
        swagger_1.ApiBearerAuth(),
        common_1.UseGuards(passport_1.AuthGuard()),
        swagger_1.ApiResponse({ status: 401, description: 'Unauthorized' }),
        common_1.Put('/validate/:id'),
        __param(0, common_1.Req()),
        __param(1, common_1.Res())
    ], ScoreController.prototype, "validate");
    __decorate([
        swagger_1.ApiBearerAuth(),
        common_1.UseGuards(passport_1.AuthGuard()),
        swagger_1.ApiResponse({ status: 401, description: 'Unauthorized' }),
        common_1.Put('/refuse/:id'),
        __param(0, common_1.Req()),
        __param(1, common_1.Res())
    ], ScoreController.prototype, "refuse");
    __decorate([
        swagger_1.ApiBearerAuth(),
        common_1.UseGuards(passport_1.AuthGuard()),
        swagger_1.ApiResponse({ status: 200, description: 'Successful Response' }),
        swagger_1.ApiResponse({ status: 401, description: 'Unauthorized' }),
        common_1.Delete(':id'),
        __param(0, common_1.Req()),
        __param(1, common_1.Res())
    ], ScoreController.prototype, "delete");
    ScoreController = __decorate([
        swagger_1.ApiTags('scores'),
        common_1.Controller('scores')
    ], ScoreController);
    return ScoreController;
}());
exports.ScoreController = ScoreController;
