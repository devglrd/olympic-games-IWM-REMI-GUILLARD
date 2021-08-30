"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.EventModule = void 0;
var common_1 = require("@nestjs/common");
var event_service_1 = require("./event.service");
var event_controller_1 = require("./event.controller");
var typeorm_1 = require("@nestjs/typeorm");
var event_entity_1 = require("./event.entity");
var eventCategory_entity_1 = require("./eventCategory.entity");
var eventCategory_controller_1 = require("./eventCategory.controller");
var category_service_1 = require("./category.service");
var auth_1 = require("../auth");
var EventModule = /** @class */ (function () {
    function EventModule() {
    }
    EventModule = __decorate([
        common_1.Module({
            imports: [typeorm_1.TypeOrmModule.forFeature([event_entity_1.Event, eventCategory_entity_1.EventCategory]), auth_1.AuthModule],
            exports: [event_service_1.EventService, category_service_1.CategoryService],
            providers: [event_service_1.EventService, category_service_1.CategoryService],
            controllers: [event_controller_1.EventController, eventCategory_controller_1.EventCategoryController]
        })
    ], EventModule);
    return EventModule;
}());
exports.EventModule = EventModule;
