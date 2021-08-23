import { Injectable } from '@nestjs/common';
import { Sport } from './sport.entity';

@Injectable()
export class SportResssource {
  static toArray(user: Sport) {
    return {
      id: user.id,
      name: user.name,
      slug: user.slug,
      content: user.content,
      file: user.file,
      event: user.event,
      createdAt: user.createdAt,
      updatedAt: user.updatedAt,
    };
  }

  static collection(users: Sport[]) {
    return users.map((user: Sport) => {
      return {
        id: user.id,
        name: user.name,
        slug: user.slug,
        content: user.content,
        file: user.file,
        event: user.event,
        createdAt: user.createdAt,
        updatedAt: user.updatedAt,
      };
    });
  }
}
