"use strict";
exports.__esModule = true;
exports.ConfigService = void 0;
var dotenv = require("dotenv");
var fs = require("fs");
var ConfigService = /** @class */ (function () {
    function ConfigService(filePath) {
        this.envConfig = dotenv.parse(fs.readFileSync(filePath));
    }
    ConfigService.prototype.get = function (key) {
        return this.envConfig[key];
    };
    ConfigService.prototype.isEnv = function (env) {
        return this.envConfig.APP_ENV === env;
    };
    return ConfigService;
}());
exports.ConfigService = ConfigService;
