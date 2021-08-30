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
exports.SportFillableFields = exports.Sport = void 0;
var typeorm_1 = require("typeorm");
var event_1 = require("../event");
var file_1 = require("../file");
var eventCategory_entity_1 = require("../event/eventCategory.entity");
var Sport = /** @class */ (function (_super) {
    __extends(Sport, _super);
    function Sport() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    __decorate([
        typeorm_1.PrimaryGeneratedColumn()
    ], Sport.prototype, "id");
    __decorate([
        typeorm_1.Column({ length: 255 })
    ], Sport.prototype, "name");
    __decorate([
        typeorm_1.Column({ length: 255, unique: true })
    ], Sport.prototype, "slug");
    __decorate([
        typeorm_1.Column({ length: 1000, nullable: true })
    ], Sport.prototype, "content");
    __decorate([
        typeorm_1.OneToOne(function (type) { return file_1.File; }, { onDelete: 'CASCADE' }),
        typeorm_1.JoinColumn({ name: 'fk_file_id' }),
        typeorm_1.Column({ nullable: true })
    ], Sport.prototype, "file");
    __decorate([
        typeorm_1.OneToMany(function (type) { return event_1.Event; }, function (event) { return event.sport; }, { eager: true, onDelete: 'CASCADE' })
    ], Sport.prototype, "event");
    __decorate([
        typeorm_1.OneToMany(function (type) { return eventCategory_entity_1.EventCategory; }, function (event) { return event.sport; }, { eager: true, onDelete: 'CASCADE' })
    ], Sport.prototype, "cat");
    __decorate([
        typeorm_1.CreateDateColumn()
    ], Sport.prototype, "createdAt");
    __decorate([
        typeorm_1.UpdateDateColumn()
    ], Sport.prototype, "updatedAt");
    Sport = __decorate([
        typeorm_1.Entity({
            name: 'sports'
        })
    ], Sport);
    return Sport;
}(typeorm_1.BaseEntity));
exports.Sport = Sport;
var SportFillableFields = /** @class */ (function () {
    function SportFillableFields() {
    }
    return SportFillableFields;
}());
exports.SportFillableFields = SportFillableFields;
