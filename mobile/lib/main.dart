import 'package:flutter/material.dart';
import 'package:mobile/pages/scores.dart';
import './pages/scores.dart' as score;
import './pages/sports.dart' as sport;

void main() {
  runApp(
      new MaterialApp(debugShowCheckedModeBanner: false, home: new MyTabs()));
}

class MyTabs extends StatefulWidget {
  @override
  MyTabsState createState() => new MyTabsState();
}

class MyTabsState extends State<MyTabs> with SingleTickerProviderStateMixin {
  late TabController controller;

  @override
  void initState() {
    super.initState();
    controller = new TabController(vsync: this, length: 2);
  }

  @override
  void dispose() {
    controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return new Scaffold(
        appBar: new AppBar(
            title: new Text("Olympics games"),
            backgroundColor: Colors.grey[800],
            bottom: new TabBar(controller: controller, tabs: <Tab>[
              new Tab(icon: new Icon(Icons.sports_score)),
              new Tab(icon: new Icon(Icons.list_alt_rounded)),
            ])),
        body: new TabBarView(controller: controller, children: <Widget>[
          new score.Score(),
          new sport.Sports(),
        ]));
  }
}
