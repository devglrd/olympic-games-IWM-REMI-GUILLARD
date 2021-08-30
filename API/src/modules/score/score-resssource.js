"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.ScoreResssource = void 0;
var common_1 = require("@nestjs/common");
var ScoreResssource = /** @class */ (function () {
    function ScoreResssource() {
    }
    ScoreResssource.toArray = function (score) {
        if (score.validate) {
            return {
                id: score.id,
                type: score.type,
                score: score.score,
                unit: score.unit,
                validate: score.validate,
                email: score.email,
                event: score.event
            };
        }
    };
    ScoreResssource.collection = function (scores) {
        return scores ? scores.map(function (score) {
            if (score.validate) {
                return {
                    id: score.id,
                    type: score.type,
                    score: score.score,
                    unit: score.unit,
                    validate: score.validate,
                    email: score.email,
                    event: score.event
                };
            }
        }).filter(function (e) { return e !== undefined; }) : [];
    };
    ScoreResssource = __decorate([
        common_1.Injectable()
    ], ScoreResssource);
    return ScoreResssource;
}());
exports.ScoreResssource = ScoreResssource;
