"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __param = (this && this.__param) || function (paramIndex, decorator) {
    return function (target, key) { decorator(target, key, paramIndex); }
};
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
exports.__esModule = true;
exports.SeedsService = void 0;
var common_1 = require("@nestjs/common");
var user_1 = require("../user");
var typeorm_1 = require("typeorm");
var typeorm_2 = require("@nestjs/typeorm");
var sport_1 = require("../sport");
var score_1 = require("../score");
var event_1 = require("../event");
var slugify_1 = require("slugify");
var eventCategory_entity_1 = require("../event/eventCategory.entity");
var SeedsService = /** @class */ (function () {
    function SeedsService(userRepository, eventRepository, sportRepository, scoreRepository, httpService, logger) {
        this.userRepository = userRepository;
        this.eventRepository = eventRepository;
        this.sportRepository = sportRepository;
        this.scoreRepository = scoreRepository;
        this.httpService = httpService;
        this.logger = logger;
        this.queryRuner = typeorm_1.getConnection().createQueryRunner();
    }
    SeedsService.prototype.truncate = function () {
        return __awaiter(this, void 0, void 0, function () {
            var queryRunnr;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        this.logger.debug('Clear all tables ...');
                        queryRunnr = typeorm_1.getConnection().createQueryRunner();
                        // queryRunnr.query('SET FOREIGN_KEY_CHECKS=0;');
                        return [4 /*yield*/, typeorm_1.getConnection().synchronize(true)];
                    case 1:
                        // queryRunnr.query('SET FOREIGN_KEY_CHECKS=0;');
                        _a.sent();
                        return [2 /*return*/];
                }
            });
        });
    };
    SeedsService.prototype.seed = function () {
        return __awaiter(this, void 0, void 0, function () {
            var users, sports, events, score;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.truncate()];
                    case 1:
                        _a.sent();
                        this.logger.debug('Run seeds');
                        return [4 /*yield*/, this.seedUser()];
                    case 2:
                        users = _a.sent();
                        this.logger.debug('Successfuly completed seeding users...');
                        return [4 /*yield*/, this.seedSport()];
                    case 3:
                        sports = _a.sent();
                        this.logger.debug('Successfuly completed seeding sport...');
                        return [4 /*yield*/, this.seedEvent()];
                    case 4:
                        events = _a.sent();
                        this.logger.debug('Successfuly completed seeding events...');
                        return [4 /*yield*/, this.seedScore()];
                    case 5:
                        score = _a.sent();
                        this.logger.debug('Successfuly completed seeding scores...');
                        return [2 /*return*/];
                }
            });
        });
    };
    SeedsService.prototype.seedUser = function () {
        return __awaiter(this, void 0, void 0, function () {
            var users, user;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        users = [];
                        this.logger.debug('Clear users tables ...');
                        user = new user_1.User();
                        user.email = "admin@olympicgames.com";
                        user.name = 'admin';
                        user.password = 'olympicgames2024+!';
                        return [4 /*yield*/, user.save()];
                    case 1:
                        _a.sent();
                        users.push(user);
                        return [2 /*return*/, users];
                }
            });
        });
    };
    SeedsService.prototype.findSport = function () {
        return this.httpService.get('http://localhost:3000/cats');
    };
    SeedsService.prototype.seedSport = function () {
        return __awaiter(this, void 0, void 0, function () {
            var sportsData, sports;
            var _this = this;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.httpService
                            .get('https://parseapi.back4app.com/classes/Listsportstokyolympic', {
                            headers: {
                                'X-Parse-Application-Id': 'Dwco6bapxxssPbLehcLJ244hWjXYhrHPGdyONZNm',
                                'X-Parse-Master-Key': 'PfOgFvxS79kRM1v7guxCyXLw93uSk348Q376mSjs'
                            }
                        })
                            .toPromise()];
                    case 1:
                        sportsData = _a.sent();
                        sports = sportsData.data.results
                            .map(function (e) { return __awaiter(_this, void 0, void 0, function () {
                            var sportFromDB, sport;
                            return __generator(this, function (_a) {
                                switch (_a.label) {
                                    case 0: return [4 /*yield*/, this.sportRepository.findOne({
                                            where: { slug: slugify_1["default"](e.Sport) }
                                        })];
                                    case 1:
                                        sportFromDB = _a.sent();
                                        if (!(sportFromDB === undefined)) return [3 /*break*/, 3];
                                        sport = new sport_1.Sport();
                                        sport.name = e.Sport;
                                        sport.slug = slugify_1["default"](e.Sport);
                                        return [4 /*yield*/, sport.save()];
                                    case 2:
                                        _a.sent();
                                        return [2 /*return*/, sport];
                                    case 3: return [2 /*return*/];
                                }
                            });
                        }); })
                            .filter(function (e) { return e; });
                        return [2 /*return*/, sports];
                }
            });
        });
    };
    SeedsService.prototype.seedEvent = function () {
        return __awaiter(this, void 0, void 0, function () {
            var eventData, events;
            var _this = this;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.httpService
                            .get('https://parseapi.back4app.com/classes/Listsportstokyolympic', {
                            headers: {
                                'X-Parse-Application-Id': 'Dwco6bapxxssPbLehcLJ244hWjXYhrHPGdyONZNm',
                                'X-Parse-Master-Key': 'PfOgFvxS79kRM1v7guxCyXLw93uSk348Q376mSjs'
                            }
                        })
                            .toPromise()];
                    case 1:
                        eventData = _a.sent();
                        events = eventData.data.results
                            .map(function (e) { return __awaiter(_this, void 0, void 0, function () {
                            var sport, event_2;
                            return __generator(this, function (_a) {
                                switch (_a.label) {
                                    case 0: return [4 /*yield*/, this.sportRepository.findOne({
                                            where: { slug: slugify_1["default"](e.Sport) }
                                        })];
                                    case 1:
                                        sport = _a.sent();
                                        if (!sport) return [3 /*break*/, 3];
                                        event_2 = new eventCategory_entity_1.EventCategory();
                                        event_2.name = e.Programme;
                                        event_2.slug = slugify_1["default"](e.Programme);
                                        event_2.type = e.Programme.includes('(Men/Women)')
                                            ? eventCategory_entity_1.Type.MenWomen
                                            : e.Programme.includes('(Men)')
                                                ? eventCategory_entity_1.Type.Men
                                                : e.Programme.includes('(Women)')
                                                    ? eventCategory_entity_1.Type.Women
                                                    : eventCategory_entity_1.Type.Unknow;
                                        event_2.sport = sport;
                                        return [4 /*yield*/, event_2.save()];
                                    case 2:
                                        _a.sent();
                                        return [2 /*return*/, event_2];
                                    case 3: return [2 /*return*/];
                                }
                            });
                        }); })
                            .filter(function (e) { return e; });
                        return [2 /*return*/, []];
                }
            });
        });
    };
    SeedsService.prototype.seedScore = function () {
        return __awaiter(this, void 0, void 0, function () { return __generator(this, function (_a) {
            return [2 /*return*/];
        }); });
    };
    SeedsService = __decorate([
        common_1.Injectable(),
        __param(0, typeorm_2.InjectRepository(user_1.User)),
        __param(1, typeorm_2.InjectRepository(event_1.Event)),
        __param(2, typeorm_2.InjectRepository(sport_1.Sport)),
        __param(3, typeorm_2.InjectRepository(score_1.Score))
    ], SeedsService);
    return SeedsService;
}());
exports.SeedsService = SeedsService;
