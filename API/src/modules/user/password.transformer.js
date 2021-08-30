"use strict";
exports.__esModule = true;
exports.PasswordTransformer = void 0;
var crypto = require("crypto");
var PasswordTransformer = /** @class */ (function () {
    function PasswordTransformer() {
    }
    PasswordTransformer.prototype.to = function (value) {
        return crypto.createHmac('sha256', value).digest('hex');
    };
    PasswordTransformer.prototype.from = function (value) {
        return value;
    };
    return PasswordTransformer;
}());
exports.PasswordTransformer = PasswordTransformer;
