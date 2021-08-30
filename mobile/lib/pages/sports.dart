import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:mobile/models/scores_model.dart';
import 'package:mobile/pages/sport_details.dart';

class Sports extends StatefulWidget {
  @override
  State<Sports> createState() => _SportsState();
}

class _SportsState extends State<Sports> {
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
    var url = Uri.parse('http://127.0.0.1:3000/api/sports');
    var response = await http.get(url);
    print('Response status: ${response.statusCode}');
    print('Response body: ${response.body}');

    List clients = (jsonDecode(response.body)['data'] as List)
        .map((data) => new Sport.fromJson(data))
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
                : Container(
          padding: const EdgeInsets.only(top: 20),
          child: listView(),
        )));
  }

  listView() {
    return ListView.builder(
      itemCount: list.length,
      itemBuilder: (context, index) {
        return  _buildRow(list[index], index, list.length);
      },
    );
  }

  _buildRow(sport, index, lenght) {
    return InkWell(
      onTap: () {
        Navigator.push(
          context,
          new MaterialPageRoute(
              builder: (BuildContext context) =>
                  new SportsDetails(id: sport.id)),
        );
      },
      child: ListTile(
          title: Container(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Row(
                  children: [
                    Flexible(
                      child: Container(
                        child: Text(
                          sport.name,
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
                            Text(
                              'Events (' + sport.event.length.toString() + ')',
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
              mainAxisAlignment: MainAxisAlignment.start,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                IconButton(
                    icon: new Icon(Icons.arrow_forward_ios),
                    // onPressed: () => Navigator.pushNamed(context, '/client'),
                    onPressed: () {
                      Navigator.push(
                        context,
                        new MaterialPageRoute(
                            builder: (BuildContext context) =>
                                new SportsDetails(id: sport.id)),
                      );
                    })
              ])),
    );
  }
}
