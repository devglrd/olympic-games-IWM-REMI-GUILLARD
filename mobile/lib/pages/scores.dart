import 'package:flutter/material.dart';
import 'package:mobile/models/scores_model.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class Score extends StatefulWidget {
  @override
  State<Score> createState() => _ScoreState();
}

class _ScoreState extends State<Score> {
  dynamic list = null;

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
    var url = Uri.parse('http://127.0.0.1:3000/api/scores');
    var response = await http.get(url);
    print('Response status: ${response.statusCode}');
    print('Response body: ${response.body}');

    List clients = (jsonDecode(response.body)['data'] as List)
        .map((data) => new Scores.fromJson(data))
        .toList();
    print(clients);

    setState(() {
      list = clients;
    });
  }

  @override
  Widget build(BuildContext context) {
    return new Container(
        alignment: Alignment.center,
        padding: const EdgeInsets.all(8.0),
        child: Container(
            child: list == null
                ? Center(
                    child: CircularProgressIndicator(),
                  )
                : listView()));
  }

  listView() {
    return ListView.builder(
      itemCount: list.length,
      itemBuilder: (context, index) {
        return _buildRow(list[index], index, list.length);
      },
    );
  }

  _buildRow(score, index, lenght) {
    return InkWell(
      onTap: () {},
      child: ListTile(
          title: Container(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  children: [
                    Flexible(
                      child: Container(
                        child: Text(
                          'Score : ' + score.score + ' ' + score.unit,
                          style: TextStyle(fontWeight: FontWeight.bold),
                        ),
                      ),
                    ),
                  ],
                ),
                Row(
                  children: [
                    Flexible(
                      child: Container(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Padding(
                              padding:
                                  const EdgeInsets.only(left: 10, bottom: 4),
                            ),
                            Text(
                              'Sport : ' + score.event.sport.name,
                              style: TextStyle(
                                  fontSize: 15, color: Colors.green[600]),
                            ),
                            Padding(
                              padding:
                                  const EdgeInsets.only(left: 10, bottom: 4),
                            ),
                            Text(
                              'Epreuve : ' + score.event.category.name,
                              style: TextStyle(
                                  fontSize: 15, color: Colors.blue[600]),
                            ),
                            Padding(
                              padding:
                                  const EdgeInsets.only(left: 10, bottom: 10),
                            ),
                            Text(
                              'Ajouter par : ' + score.email.toString(),
                              style: TextStyle(
                                  fontSize: 13, color: Colors.grey[600]),
                            ),
                          ],
                        ),
                      ),
                    )
                  ],
                ),
                Padding(padding: const EdgeInsets.only(bottom: 10)),
                Divider(
                  color: Colors.grey,
                  height: 1,
                ),
                Padding(padding: const EdgeInsets.only(bottom: 10)),
              ],
            ),
          ),
          trailing: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              score.type == "Gold"
                  ? Image.asset(
                      'assets/goldcup.png',
                      height: 30,
                      width: 40,
                    )
                  : (score.type == "Silver"
                      ? Image.asset(
                          'assets/silver.png',
                          height: 30,
                          width: 40,
                        )
                      : (score.type == "Bronze"
                          ? Image.asset(
                              'assets/bronze.png',
                              height: 30,
                              width: 40,
                            )
                          : Container()))
            ],
          )),
    );
  }
}
