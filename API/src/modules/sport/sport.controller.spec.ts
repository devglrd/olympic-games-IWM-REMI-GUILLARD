import { Test, TestingModule } from '@nestjs/testing';
import { SportController } from './sport.controller';

describe('SportController', () => {
  let controller: SportController;

  beforeEach(async () => {
    const module: TestingModule = await Test.createTestingModule({
      controllers: [SportController],
    }).compile();

    controller = module.get<SportController>(SportController);
  });

  it('should be defined', () => {
    expect(controller).toBeDefined();
  });
});
