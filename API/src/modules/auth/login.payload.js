"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.LoginPayload = void 0;
var swagger_1 = require("@nestjs/swagger");
var class_validator_1 = require("class-validator");
var LoginPayload = /** @class */ (function () {
    function LoginPayload() {
    }
    __decorate([
        swagger_1.ApiProperty({
            required: true
        })
    ], LoginPayload.prototype, "email");
    __decorate([
        swagger_1.ApiProperty({
            required: true
        }),
        class_validator_1.IsNotEmpty(),
        class_validator_1.MinLength(5)
    ], LoginPayload.prototype, "password");
    return LoginPayload;
}());
exports.LoginPayload = LoginPayload;
