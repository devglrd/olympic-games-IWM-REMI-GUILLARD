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
exports.EventFillableFields = exports.EventCategory = exports.Type = void 0;
var typeorm_1 = require("typeorm");
var sport_1 = require("../sport");
var event_entity_1 = require("./event.entity");
var Type;
(function (Type) {
    Type["Men"] = "Men";
    Type["Women"] = "Women";
    Type["MenWomen"] = "MenWomen";
    Type["Unknow"] = "unknow";
})(Type = exports.Type || (exports.Type = {}));
var EventCategory = /** @class */ (function (_super) {
    __extends(EventCategory, _super);
    function EventCategory() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    __decorate([
        typeorm_1.PrimaryGeneratedColumn()
    ], EventCategory.prototype, "id");
    __decorate([
        typeorm_1.Column({ length: 255 })
    ], EventCategory.prototype, "name");
    __decorate([
        typeorm_1.Column('text', { nullable: true })
    ], EventCategory.prototype, "type");
    __decorate([
        typeorm_1.Column({ length: 255, unique: true })
    ], EventCategory.prototype, "slug");
    __decorate([
        typeorm_1.ManyToOne(function (type) { return sport_1.Sport; }, function (sport) { return sport.event; })
    ], EventCategory.prototype, "sport");
    __decorate([
        typeorm_1.OneToMany(function (type) { return event_entity_1.Event; }, function (event) { return event.category; }, { onDelete: 'CASCADE' })
    ], EventCategory.prototype, "events");
    EventCategory = __decorate([
        typeorm_1.Entity({
            name: 'events_category'
        })
    ], EventCategory);
    return EventCategory;
}(typeorm_1.BaseEntity));
exports.EventCategory = EventCategory;
var EventFillableFields = /** @class */ (function () {
    function EventFillableFields() {
    }
    return EventFillableFields;
}());
exports.EventFillableFields = EventFillableFields;
