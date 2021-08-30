import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:mobile/models/scores_model.dart';

class SportsDetails extends StatefulWidget {
  final int id;
  static const routeName = '/detailsSport';
  late ValueChanged<int> onPush;

  SportsDetails({Key? key, required this.id}) : super(key: key);

  @override
  State<SportsDetails> createState() => _SportsDetailsState();
}

class _SportsDetailsState extends State<SportsDetails> {
  dynamic data = null;

  @override
  void initState() {
    // TODO: implement initState
    //future = getdata();
    //focusNode.addListener(() {
    /*  if (focusNode.hasFocus) {
        hintText = '';
      } else {
        hintText = 'Rechercher un élève';
      }
      setState(() {});
    });*/
    getData();
    super.initState();
  }

  getData() async {
    var url =
        Uri.parse('http://127.0.0.1:3000/api/sports/' + widget.id.toString());
    var response = await http.get(url);
    print('Response status: ${response.statusCode}');
    print('Response body: ${response.body}');

    setState(() {
      data = new Sport.fromJson(jsonDecode(response.body)['data']);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: new Container(
            alignment: Alignment.center,
            padding: const EdgeInsets.all(8.0),
            child: Container(
                child: data == null
                    ? Center(
                        child: CircularProgressIndicator(),
                      )
                    : buildPage())),
      ),
    );
  }

  buildPage() {
    return Container(
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Container(
                padding: const EdgeInsets.only(left: 10),
                child: InkWell(
                    onTap: () {
                      Navigator.pop(context);
                    },
                    child: Icon(
                      Icons.arrow_back,
                      color: Colors.black,
                      size: 30.0,
                    )),
              ),
              Container(
                width: MediaQuery.of(context).size.width / 1.4,
                child: Text(
                  data.name,
                  style: TextStyle(
                      fontSize: 30,
                      fontWeight: FontWeight.bold,
                      color: Colors.blue[900]),
                ),
              ),
            ],
          ),
          Padding(padding: const EdgeInsets.only(bottom: 20)),
          Divider(
            height: 1,
            color: Colors.grey,
          ),
          Container(
            padding: const EdgeInsets.only(top: 30, left: 20, right: 20),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Container(
                  child: Text(data.content != null ? data.content : ''),
                ),
              ],
            ),
          ),
          Padding(padding: const EdgeInsets.only(bottom: 20)),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Container(
                padding: const EdgeInsets.only(bottom: 20),
                child: Text(
                  'Events',
                  style: TextStyle(
                      fontSize: 30,
                      fontWeight: FontWeight.bold,
                      color: Colors.blue[900]),
                ),
              )
            ],
          ),
          Expanded(
              child: MediaQuery.removePadding(
            context: context,
            removeTop: true,
            child: GridView.builder(
                gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                  crossAxisCount: 1,
                ),
                itemCount: data.event.length,
                itemBuilder: (BuildContext context, int index) {
                  return Container(
                    alignment: Alignment.topCenter,
                    margin: const EdgeInsets.all(3.0),
                    padding:
                        const EdgeInsets.only(top: 20.0, left: 10, right: 10),
                    decoration:
                        BoxDecoration(border: Border.all(color: Colors.black)),
                    child: Column(
                      children: [
                        Text(data.event[index].name,
                            style: TextStyle(color: Colors.deepOrange[800])),
                        Padding(
                          padding: const EdgeInsets.only(top: 20.0),
                        ),
                        Text(data.event[index].category.name,
                            style: TextStyle(color: Colors.blue[800])),
                        Padding(
                          padding: const EdgeInsets.only(top: 20.0),
                        ),
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text('Lieu : ' + data.event[index].location),
                            Padding(
                              padding: const EdgeInsets.only(top: 5.0),
                            ),
                            Divider(
                              height: 1,
                            ),
                            Padding(
                              padding: const EdgeInsets.only(top: 5.0),
                            ),
                            Text('Date et Heure : ' +
                                data.event[index].startAt +
                                ' ' +
                                data.event[index].time),
                            Padding(
                              padding: const EdgeInsets.only(top: 5.0),
                            ),
                            Divider(
                              height: 1,
                            ),
                            Padding(
                              padding: const EdgeInsets.only(top: 5.0),
                            ),
                            Text('Description  : ' + data.event[index].content),
                            Padding(
                              padding: const EdgeInsets.only(top: 5.0),
                            ),
                            Divider(
                              height: 1,
                            ),
                            Padding(
                              padding: const EdgeInsets.only(top: 5.0),
                            ),
                          ],
                        ),
                        Padding(
                          padding: const EdgeInsets.only(top: 10.0),
                        ),
                        Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            Text('Médailles'),
                          ],
                        ),
                        buildScores(data.event[index].scores)
                      ],
                    ),
                  );
                }),
          ))
        ],
      ),
    );
  }

  buildScores(scores) {
    List<Widget> list = [];
    for (var i = 0; i < scores.length; i++) {
      list.add(
        Container(
          padding: const EdgeInsets.only(left: 5, right: 5),
          child: new Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                Container(
                  child: scores[i].type == "Gold"
                      ? Image.asset(
                          'assets/goldcup.png',
                          height: 20,
                          width: 20,
                        )
                      : (scores[i].type == "Silver"
                          ? Image.asset(
                              'assets/silver.png',
                              height: 20,
                              width: 20,
                            )
                          : (scores[i].type == "Bronze"
                              ? Image.asset(
                                  'assets/bronze.png',
                                  height: 20,
                                  width: 20,
                                )
                              : Container())),
                ),
                Text(
                  scores[i].type,
                  style: TextStyle(fontSize: 10),
                ),
                Padding(padding: const EdgeInsets.only(bottom: 7)),
                Container(
                  child: Text(scores[i].score + ' ' + scores[i].unit),
                ),
                Padding(padding: const EdgeInsets.only(bottom: 7)),
                Column(
                  children: [
                    Container(
                      child:
                          Text('Soumis par : ', style: TextStyle(fontSize: 10)),
                    ),
                    Container(
                        child: Text(scores[i].email,
                            style: TextStyle(fontSize: 10))),
                  ],
                )
              ]),
        ),
      );
    }
    return Padding(
      padding: const EdgeInsets.only(top: 20.0),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: list,
      ),
    );
  }
}
