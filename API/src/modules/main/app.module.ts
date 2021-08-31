import { Module } from '@nestjs/common';
import { TypeOrmModule, TypeOrmModuleAsyncOptions } from '@nestjs/typeorm';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { ConfigModule, ConfigService } from '../config';
import { UserModule } from '../user';
import { AuthModule } from '../auth';
import { SeedsModule } from '../seeds/seeds.module';
import { SportModule } from '../sport';
import { ScoreModule } from '../score';
import { EventModule } from '../event';
// import { ConfigModule, ConfigService } from './../config';
// import { AuthModule } from './../auth';
// import { ArticleModule } from '../article/article.module';
// import { SeedsModule } from '../seeds/seeds.module';
import { MailerModule } from '@nestjs-modules/mailer';
import { HandlebarsAdapter } from '@nestjs-modules/mailer/dist/adapters/handlebars.adapter';
import { patchSelectQueryBuilder } from 'typeorm-global-scopes';

@Module({
  imports: [
    TypeOrmModule.forRootAsync({
      imports: [ConfigModule],
      inject: [ConfigService],
      useFactory: (configService: ConfigService) => {
        patchSelectQueryBuilder();
        return {
          type: configService.get('DB_TYPE'),
          host: configService.get('DB_HOST'),
          port: configService.get('DB_PORT'),
          username: configService.get('DB_USERNAME'),
          password: configService.get('DB_PASSWORD'),
          database: configService.get('DB_DATABASE'),
          entities: [__dirname + './../**/**.entity{.ts,.js}'],
          synchronize: configService.isEnv('dev'),
        } as TypeOrmModuleAsyncOptions;
      },
    }),
    MailerModule.forRootAsync({
      imports: [ConfigModule],
      inject: [ConfigService],
      useFactory: (configService: ConfigService) => {
        return {
          transport: `${configService.get('MAIL_DRIVER')}://${configService.get(
            'MAIL_USERNAME',
          )}:${configService.get('MAIL_PASSWORD')}@${configService.get(
            'MAIL_HOST',
          )}:${configService.get('MAIL_PORT')}`,
          defaults: {
            from: '"nest-modules" <modules@nestjs.com>',
          },
          template: {
            dir: process.cwd() + '/mails/',
            adapter: new HandlebarsAdapter(),
            options: {
              strict: true,
            },
          },
        };
      },
    }),
    ConfigModule,
    UserModule,
    AuthModule,
    SeedsModule,
    SportModule,
    EventModule,
    ScoreModule,
  ],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
