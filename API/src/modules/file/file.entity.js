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
exports.File = void 0;
var typeorm_1 = require("typeorm");
var user_1 = require("../user");
var File = /** @class */ (function (_super) {
    __extends(File, _super);
    function File() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    __decorate([
        typeorm_1.PrimaryGeneratedColumn()
    ], File.prototype, "id");
    __decorate([
        typeorm_1.Column({ length: 5000 })
    ], File.prototype, "file");
    __decorate([
        typeorm_1.Column({ length: 1000, nullable: true })
    ], File.prototype, "slug");
    __decorate([
        typeorm_1.Column()
    ], File.prototype, "type");
    __decorate([
        typeorm_1.Column()
    ], File.prototype, "name");
    __decorate([
        typeorm_1.OneToOne(function (type) { return user_1.User; }),
        typeorm_1.JoinColumn({ name: 'fk_user_id' })
    ], File.prototype, "user");
    __decorate([
        typeorm_1.CreateDateColumn()
    ], File.prototype, "createdAt");
    __decorate([
        typeorm_1.UpdateDateColumn()
    ], File.prototype, "updatedAt");
    File = __decorate([
        typeorm_1.Entity({
            name: 'files'
        })
    ], File);
    return File;
}(typeorm_1.BaseEntity));
exports.File = File;
