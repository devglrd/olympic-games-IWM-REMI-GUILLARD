class Scores {
  dynamic id;
  dynamic type;
  dynamic score;
  dynamic unit;
  dynamic validate;
  dynamic email;
  dynamic event;

  Scores({
    this.id,
    this.type,
    this.score,
    this.unit,
    this.validate,
    this.email,
  });

  Scores.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    type = json['type'];
    score = json['score'];
    unit = json['unit'];
    validate = json['validate'];
    email = json['email'];
    event = json['event'] != null ? new Event.fromJson(json['event']) : null;
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['type'] = this.type;
    data['score'] = this.score;
    data['unit'] = this.unit;
    data['validate'] = this.validate;
    data['email'] = this.email;
    if (this.event != null) {
      data['event'] = this.event.toJson();
    }
    return data;
  }
}

class Event {
  dynamic id;
  dynamic name;
  dynamic location;
  dynamic startAt;
  dynamic time;
  dynamic content;
  dynamic sport;
  dynamic category;
  dynamic scores;
  Event(
      {this.id,
      this.scores,
      this.name,
      this.location,
      this.startAt,
      this.time,
      this.sport,
      this.content,
      this.category});

  Event.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    name = json['name'];
    location = json['location'];
    startAt = json['startAt'];
    time = json['time'];
    category = json['category'] != null
        ? new Category.fromJson(json['category'])
        : null;
    content = json['content'];

    if (json['scores'] != null) {
      scores = [];
      json['scores'].forEach((v) {
        scores.add(new Scores.fromJson(v));
      });
    }

    sport = json['sport'] != null ? new Sport.fromJson(json['sport']) : null;
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['name'] = this.name;
    data['location'] = this.location;
    data['startAt'] = this.startAt;
    data['time'] = this.time;
    data['content'] = this.content;
    if (this.sport != null) {
      data['event'] = this.sport.toJson();
    }
    if (this.category != null) {
      data['category'] = this.category.toJson();
    }

    if (this.scores != null) {
      data['scores'] = this.scores.map((v) => v.toJson()).toList();
    }


    return data;
  }
}

class Category {
  dynamic id;
  dynamic name;
  dynamic slug;
  dynamic type;

  Category({this.id, this.name, this.slug, this.type});

  Category.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    name = json['name'];
    slug = json['slug'];
    type = json['type'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['name'] = this.name;
    data['slug'] = this.slug;
    data['type'] = this.type;
    return data;
  }
}

class Sport {
  dynamic id;
  dynamic name;
  dynamic content;
  dynamic slug;
  dynamic createdAt;
  dynamic updatedAt;
  dynamic event;

  Sport(
      {this.event,
      this.id,
      this.name,
      this.content,
      this.slug,
      this.createdAt,
      this.updatedAt});

  Sport.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    name = json['name'];
    slug = json['slug'];
    content = json['content'];
    createdAt = json['createdAt'];
    updatedAt = json['updatedAt'];
    if (json['event'] != null) {
      event = [];
      json['event'].forEach((v) {
        event.add(new Event.fromJson(v));
      });
    }
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['name'] = this.name;
    data['content'] = this.content;
    data['slug'] = this.slug;
    data['createdAt'] = this.createdAt;
    data['updatedAt'] = this.updatedAt;
    if (this.event != null) {
      data['event'] = this.event.map((v) => v.toJson()).toList();
    }
    return data;
  }
}
