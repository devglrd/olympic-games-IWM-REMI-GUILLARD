"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.EventResssource = void 0;
var common_1 = require("@nestjs/common");
var score_resssource_1 = require("../score/score-resssource");
var EventResssource = /** @class */ (function () {
    function EventResssource() {
    }
    EventResssource.toArray = function (event) {
        return {
            id: event.id,
            name: event.name,
            location: event.location,
            content: event.content,
            startAt: event.startAt,
            time: event.time,
            sport: event.sport,
            scores: score_resssource_1.ScoreResssource.collection(event.scores),
            category: event.category
        };
    };
    EventResssource.collection = function (events) {
        return events ? events.map(function (event) {
            return {
                id: event.id,
                name: event.name,
                location: event.location,
                content: event.content,
                startAt: event.startAt,
                time: event.time,
                sport: event.sport,
                scores: score_resssource_1.ScoreResssource.collection(event.scores),
                category: event.category
            };
        }) : [];
    };
    EventResssource = __decorate([
        common_1.Injectable()
    ], EventResssource);
    return EventResssource;
}());
exports.EventResssource = EventResssource;
