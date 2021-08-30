import 'package:http/http.dart' as http;

class HttpService {
  final String baseApi = "http://127.0.0.1:3000/api";
  makeGetRequest(String url) async {
    return await http.get(Uri.parse(url));
  }
}
