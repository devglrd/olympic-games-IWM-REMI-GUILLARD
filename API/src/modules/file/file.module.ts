import { Module } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { File } from './file.entity';
import { FileService } from './file.service';
import { UsersService } from '../user';
import { UserRessource } from '../user/user-resssource';

@Module({
  imports: [TypeOrmModule.forFeature([File])],
  providers: [FileService],
  exports: [FileService],
})
export class FileModule {}
