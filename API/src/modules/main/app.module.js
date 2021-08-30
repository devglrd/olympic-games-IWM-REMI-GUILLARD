"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.AppModule = void 0;
var common_1 = require("@nestjs/common");
var typeorm_1 = require("@nestjs/typeorm");
var app_controller_1 = require("./app.controller");
var app_service_1 = require("./app.service");
var config_1 = require("../config");
var user_1 = require("../user");
var auth_1 = require("../auth");
var seeds_module_1 = require("../seeds/seeds.module");
var sport_1 = require("../sport");
var score_1 = require("../score");
var event_1 = require("../event");
// import { ConfigModule, ConfigService } from './../config';
// import { AuthModule } from './../auth';
// import { ArticleModule } from '../article/article.module';
// import { SeedsModule } from '../seeds/seeds.module';
var mailer_1 = require("@nestjs-modules/mailer");
var handlebars_adapter_1 = require("@nestjs-modules/mailer/dist/adapters/handlebars.adapter");
var AppModule = /** @class */ (function () {
    function AppModule() {
    }
    AppModule = __decorate([
        common_1.Module({
            imports: [
                typeorm_1.TypeOrmModule.forRootAsync({
                    imports: [config_1.ConfigModule],
                    inject: [config_1.ConfigService],
                    useFactory: function (configService) {
                        return {
                            type: configService.get('DB_TYPE'),
                            host: configService.get('DB_HOST'),
                            port: configService.get('DB_PORT'),
                            username: configService.get('DB_USERNAME'),
                            password: configService.get('DB_PASSWORD'),
                            database: configService.get('DB_DATABASE'),
                            entities: [__dirname + './../**/**.entity{.ts,.js}'],
                            synchronize: configService.isEnv('dev')
                        };
                    }
                }),
                mailer_1.MailerModule.forRootAsync({
                    imports: [config_1.ConfigModule],
                    inject: [config_1.ConfigService],
                    useFactory: function (configService) {
                        return {
                            transport: configService.get('MAIL_DRIVER') + "://" + configService.get('MAIL_USERNAME') + ":" + configService.get('MAIL_PASSWORD') + "@" + configService.get('MAIL_HOST') + ":" + configService.get('MAIL_PORT'),
                            defaults: {
                                from: '"nest-modules" <modules@nestjs.com>'
                            },
                            template: {
                                dir: process.cwd() + '/mails/',
                                adapter: new handlebars_adapter_1.HandlebarsAdapter(),
                                options: {
                                    strict: true
                                }
                            }
                        };
                    }
                }),
                config_1.ConfigModule,
                user_1.UserModule,
                auth_1.AuthModule,
                seeds_module_1.SeedsModule,
                sport_1.SportModule,
                event_1.EventModule,
                score_1.ScoreModule,
            ],
            controllers: [app_controller_1.AppController],
            providers: [app_service_1.AppService]
        })
    ], AppModule);
    return AppModule;
}());
exports.AppModule = AppModule;
