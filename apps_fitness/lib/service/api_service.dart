import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class ApiService {
  static const String baseUrl = "http://localhost/api";
  String? _authToken;

  // Constructor untuk memuat token saat pertama kali aplikasi dijalankan
  ApiService() {
    _loadAuthToken(); // Membaca token yang sudah disimpan saat aplikasi dijalankan
  }

  // Membaca token dari SharedPreferences
  Future<void> _loadAuthToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    _authToken =
        prefs.getString('authToken'); // Membaca token dari SharedPreferences
  }

  // Simpan token setelah login
  Future<void> setAuthToken(String token) async {
    _authToken = token;
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setString('authToken', token); // Menyimpan token ke SharedPreferences
  }

  // Hapus token saat logout
  Future<void> logout() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.remove('authToken'); // Menghapus token dari SharedPreferences
    _authToken = null; // Reset token di memory
  }

  // Helper function to set headers with Authorization
  Map<String, String> _getHeaders() {
    if (_authToken == null) {
      throw Exception("Authentication token is not set.");
    }

    return {
      'Authorization': 'Bearer $_authToken', // Token Bearer untuk autentikasi
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    };
  }

  // Fungsi login
  Future<String> login(String email, String password) async {
    final url = Uri.parse("$baseUrl/login");

    final response = await http.post(
      url,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: {
        'email': email,
        'password': password,
      },
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data['token'] != null) {
        await setAuthToken(
            data['token']); // Simpan token setelah login berhasil
        return data['token'];
      } else {
        throw Exception("Token not found in response.");
      }
    } else if (response.statusCode == 403) {
      throw Exception("You are not authorized to login.");
    } else if (response.statusCode == 401) {
      throw Exception("Incorrect email or password.");
    } else {
      throw Exception("Login failed: ${response.body}");
    }
  }

  // Fungsi untuk mengambil data pelatihan
  Future<List<dynamic>> fetchPelatihans() async {
    final url = Uri.parse("$baseUrl/pelatihans");

    final response = await http.get(url, headers: _getHeaders());

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      return data['data']; // Mengambil data pelatihan dari response
    } else {
      throw Exception("Failed to load pelatihans");
    }
  }

  // Fungsi untuk mengambil data client berdasarkan ID
  Future<Map<String, dynamic>> fetchClient() async {
    final url = Uri.parse("$baseUrl/clients");

    try {
      final response = await http.get(url, headers: _getHeaders());

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data;
      } else {
        throw Exception("Failed to load client: ${response.body}");
      }
    } catch (e) {
      throw Exception("Error fetching client: $e");
    }
  }

  // Fungsi untuk mengambil data pelatih berdasarkan ID
  Future<dynamic> fetchEmployee(int id) async {
    final url = Uri.parse("$baseUrl/employees/$id");

    final response = await http.get(url, headers: _getHeaders());

    if (response.statusCode == 200) {
      return json
          .decode(response.body); // Mengambil data employee dari response
    } else {
      throw Exception("Failed to load employee");
    }
  }

  // Fungsi untuk mengambil data user berdasarkan token
  Future<Map<String, dynamic>> fetchUser() async {
    final url = Uri.parse("$baseUrl/user");

    final response = await http.get(url, headers: _getHeaders());

    if (response.statusCode == 200) {
      return json.decode(response.body); // Mengambil data user dari response
    } else {
      throw Exception("Failed to load user data");
    }
  }
}
