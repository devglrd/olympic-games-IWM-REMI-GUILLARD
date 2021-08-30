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
exports.EventFillableFields = exports.Event = void 0;
var typeorm_1 = require("typeorm");
var sport_1 = require("../sport");
var score_1 = require("../score");
var eventCategory_entity_1 = require("./eventCategory.entity");
var class_transformer_1 = require("class-transformer");
var Event = /** @class */ (function (_super) {
    __extends(Event, _super);
    function Event() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    __decorate([
        typeorm_1.PrimaryGeneratedColumn()
    ], Event.prototype, "id");
    __decorate([
        typeorm_1.Column({ length: 255 })
    ], Event.prototype, "name");
    __decorate([
        typeorm_1.Column({ length: 255 })
    ], Event.prototype, "location");
    __decorate([
        class_transformer_1.Type(function () { return Date; }),
        typeorm_1.Column('text')
    ], Event.prototype, "startAt");
    __decorate([
        typeorm_1.Column({ length: 255 })
    ], Event.prototype, "time");
    __decorate([
        typeorm_1.Column({ length: 255 })
    ], Event.prototype, "content");
    __decorate([
        typeorm_1.ManyToOne(function (type) { return sport_1.Sport; }, function (sport) { return sport.event; })
    ], Event.prototype, "sport");
    __decorate([
        typeorm_1.ManyToOne(function (type) { return eventCategory_entity_1.EventCategory; }, function (cat) { return cat.events; }, { eager: true, onDelete: 'CASCADE' })
    ], Event.prototype, "category");
    __decorate([
        typeorm_1.OneToMany(function (type) { return score_1.Score; }, function (event) { return event.event; }, { eager: true, onDelete: 'CASCADE' })
    ], Event.prototype, "scores");
    Event = __decorate([
        typeorm_1.Entity({
            name: 'events'
        })
    ], Event);
    return Event;
}(typeorm_1.BaseEntity));
exports.Event = Event;
var EventFillableFields = /** @class */ (function () {
    function EventFillableFields() {
    }
    return EventFillableFields;
}());
exports.EventFillableFields = EventFillableFields;
