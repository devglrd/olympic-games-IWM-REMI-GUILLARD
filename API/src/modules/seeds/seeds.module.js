"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.SeedsModule = void 0;
var common_1 = require("@nestjs/common");
var seeds_controller_1 = require("./seeds.controller");
var seeds_service_1 = require("./seeds.service");
var user_1 = require("../user");
var typeorm_1 = require("@nestjs/typeorm");
var config_1 = require("../config");
var sport_1 = require("../sport");
var score_1 = require("../score");
var event_1 = require("../event");
var eventCategory_entity_1 = require("../event/eventCategory.entity");
var SeedsModule = /** @class */ (function () {
    function SeedsModule() {
    }
    SeedsModule = __decorate([
        common_1.Module({
            imports: [
                common_1.HttpModule,
                config_1.ConfigModule,
                typeorm_1.TypeOrmModule.forFeature([user_1.User, sport_1.Sport, score_1.Score, event_1.Event, eventCategory_entity_1.EventCategory]),
            ],
            controllers: [seeds_controller_1.SeedsController],
            providers: [seeds_service_1.SeedsService, common_1.Logger]
        })
    ], SeedsModule);
    return SeedsModule;
}());
exports.SeedsModule = SeedsModule;
