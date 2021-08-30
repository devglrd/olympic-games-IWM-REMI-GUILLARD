"use strict";
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.ScoreFillableFields = exports.Score = void 0;
var typeorm_1 = require("typeorm");
var event_1 = require("../event");
var Score = /** @class */ (function (_super) {
    __extends(Score, _super);
    function Score() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    __decorate([
        typeorm_1.PrimaryGeneratedColumn()
    ], Score.prototype, "id");
    __decorate([
        typeorm_1.Column({ length: 255 }) // EX : GOLD, SILVER, BRONZE
    ], Score.prototype, "type");
    __decorate([
        typeorm_1.Column({ length: 255 }) // EX : 130, 70, 20
    ], Score.prototype, "score");
    __decorate([
        typeorm_1.Column({ length: 255 }) // EX : MINUTE, LENGTH, SCORE
    ], Score.prototype, "unit");
    __decorate([
        typeorm_1.Column()
    ], Score.prototype, "validate");
    __decorate([
        typeorm_1.Column({ length: 255 })
    ], Score.prototype, "email");
    __decorate([
        typeorm_1.ManyToOne(function (type) { return event_1.Event; }, function (event) { return event.scores; })
    ], Score.prototype, "event");
    Score = __decorate([
        typeorm_1.Entity({
            name: 'scores'
        })
    ], Score);
    return Score;
}(typeorm_1.BaseEntity));
exports.Score = Score;
var ScoreFillableFields = /** @class */ (function () {
    function ScoreFillableFields() {
    }
    return ScoreFillableFields;
}());
exports.ScoreFillableFields = ScoreFillableFields;
