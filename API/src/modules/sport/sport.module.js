"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.SportModule = void 0;
var common_1 = require("@nestjs/common");
var sport_service_1 = require("./sport.service");
var sport_controller_1 = require("./sport.controller");
var typeorm_1 = require("@nestjs/typeorm");
var sport_entity_1 = require("./sport.entity");
var auth_1 = require("../auth");
var SportModule = /** @class */ (function () {
    function SportModule() {
    }
    SportModule = __decorate([
        common_1.Module({
            imports: [typeorm_1.TypeOrmModule.forFeature([sport_entity_1.Sport]), auth_1.AuthModule],
            providers: [sport_service_1.SportService],
            controllers: [sport_controller_1.SportController],
            exports: [sport_service_1.SportService, typeorm_1.TypeOrmModule.forFeature([sport_entity_1.Sport])]
        })
    ], SportModule);
    return SportModule;
}());
exports.SportModule = SportModule;
