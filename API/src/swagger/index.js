"use strict";
exports.__esModule = true;
exports.setupSwagger = void 0;
var swagger_1 = require("@nestjs/swagger");
var constants_1 = require("./constants");
var setupSwagger = function (app) {
    var options = new swagger_1.DocumentBuilder()
        .setTitle(constants_1.SWAGGER_API_NAME)
        .setDescription(constants_1.SWAGGER_API_DESCRIPTION)
        .setVersion(constants_1.SWAGGER_API_CURRENT_VERSION)
        .setBasePath('/api')
        .build();
    var document = swagger_1.SwaggerModule.createDocument(app, options);
    swagger_1.SwaggerModule.setup(constants_1.SWAGGER_API_ROOT, app, document);
};
exports.setupSwagger = setupSwagger;
