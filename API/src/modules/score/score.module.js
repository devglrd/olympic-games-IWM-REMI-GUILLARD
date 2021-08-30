"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.ScoreModule = void 0;
var common_1 = require("@nestjs/common");
var score_controller_1 = require("./score.controller");
var score_service_1 = require("./score.service");
var typeorm_1 = require("@nestjs/typeorm");
var score_entity_1 = require("./score.entity");
var auth_1 = require("../auth");
var nestjs_moment_1 = require("@ccmos/nestjs-moment");
var ScoreModule = /** @class */ (function () {
    function ScoreModule() {
    }
    ScoreModule = __decorate([
        common_1.Module({
            imports: [nestjs_moment_1.MomentModule.forRoot({
                    tz: 'Europe/London'
                }), typeorm_1.TypeOrmModule.forFeature([score_entity_1.Score]), auth_1.AuthModule],
            exports: [score_service_1.ScoreService],
            controllers: [score_controller_1.ScoreController],
            providers: [score_service_1.ScoreService]
        })
    ], ScoreModule);
    return ScoreModule;
}());
exports.ScoreModule = ScoreModule;
