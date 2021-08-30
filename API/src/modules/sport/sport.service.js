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
var __spreadArray = (this && this.__spreadArray) || function (to, from) {
    for (var i = 0, il = from.length, j = to.length; i < il; i++, j++)
        to[j] = from[i];
    return to;
};
exports.__esModule = true;
exports.SportService = void 0;
var common_1 = require("@nestjs/common");
var typeorm_1 = require("@nestjs/typeorm");
var typeorm_2 = require("typeorm");
var sport_entity_1 = require("./sport.entity");
var slugify_1 = require("slugify");
var event_1 = require("../event");
var SportService = /** @class */ (function () {
    function SportService(sportRepository) {
        this.sportRepository = sportRepository;
    }
    SportService.prototype.index = function () {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                return [2 /*return*/, this.sportRepository.find({ relations: ['event', 'event.scores'] })];
            });
        });
    };
    SportService.prototype.find = function (slug) {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                return [2 /*return*/, this.sportRepository.find({ where: { slug: slug } })];
            });
        });
    };
    SportService.prototype.findOne = function (id) {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                return [2 /*return*/, this.sportRepository.findOne({ where: { id: id } })];
            });
        });
    };
    SportService.prototype.filterSport = function (query) {
        return __awaiter(this, void 0, void 0, function () {
            var date, events, sport, _a, _b, entityManager;
            return __generator(this, function (_c) {
                switch (_c.label) {
                    case 0:
                        date = new Date().toLocaleDateString();
                        return [4 /*yield*/, event_1.Event.find({ relations: ['category', 'category.sport'], where: { startAt: date.toString() } })];
                    case 1:
                        events = _c.sent();
                        _a = [[]];
                        _b = Set.bind;
                        return [4 /*yield*/, events.map(function (e) {
                                return e.category.sport.id;
                            })];
                    case 2:
                        sport = __spreadArray.apply(void 0, _a.concat([new (_b.apply(Set, [void 0, _c.sent()]))()]));
                        entityManager = typeorm_2.getManager();
                        return [4 /*yield*/, entityManager
                                .createQueryBuilder(sport_entity_1.Sport, "sports")
                                .where("sports.id IN (:...ids)", {
                                ids: sport
                            })
                                .getMany()];
                    case 3: return [2 /*return*/, _c.sent()];
                }
            });
        });
    };
    SportService.prototype.store = function (data) {
        return __awaiter(this, void 0, void 0, function () {
            var sport;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        sport = new sport_entity_1.Sport();
                        sport.name = data.name;
                        sport.slug = slugify_1["default"](data.name);
                        sport.content = data.content;
                        return [4 /*yield*/, sport.save()];
                    case 1: return [2 /*return*/, _a.sent()];
                }
            });
        });
    };
    SportService.prototype.update = function (data, id) {
        return __awaiter(this, void 0, void 0, function () {
            var sport;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, this.sportRepository.findOne({ where: { id: id } })];
                    case 1:
                        sport = _a.sent();
                        sport.name = data.name;
                        sport.slug = slugify_1["default"](data.name);
                        sport.content = data.content;
                        return [4 /*yield*/, sport.save()];
                    case 2: return [2 /*return*/, _a.sent()];
                }
            });
        });
    };
    SportService.prototype["delete"] = function (id) {
        return __awaiter(this, void 0, void 0, function () {
            var sport;
            var _this = this;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4 /*yield*/, sport_entity_1.Sport.findOne({ where: { id: id } })];
                    case 1:
                        sport = _a.sent();
                        console.log(sport.cat, '----');
                        return [4 /*yield*/, sport.cat.forEach(function (e) { return __awaiter(_this, void 0, void 0, function () {
                                return __generator(this, function (_a) {
                                    switch (_a.label) {
                                        case 0: return [4 /*yield*/, e.remove()];
                                        case 1:
                                            _a.sent();
                                            return [2 /*return*/];
                                    }
                                });
                            }); })];
                    case 2:
                        _a.sent();
                        return [4 /*yield*/, sport.remove()];
                    case 3: return [2 /*return*/, _a.sent()];
                }
            });
        });
    };
    SportService = __decorate([
        common_1.Injectable(),
        __param(0, typeorm_1.InjectRepository(sport_entity_1.Sport))
    ], SportService);
    return SportService;
}());
exports.SportService = SportService;
