import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:get/get.dart';

import '../service/api_service.dart';

class ProfilePage extends StatefulWidget {
  @override
  _ProfilePageState createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  final ApiService _apiService = Get.find();
  bool _isLoading = true;
  Map<String, dynamic> _clientData = {};

  @override
  void initState() {
    super.initState();
    _fetchClientData(); // Ambil data client berdasarkan pengguna yang sedang login
  }

  // Fungsi untuk mengambil data client dari API
  Future<void> _fetchClientData() async {
    try {
      final response = await _apiService.fetchClient(); // Mengambil data client
      setState(() {
        if (response['data'] != null && response['data'].isNotEmpty) {
          _clientData = response['data'][0]; // Ambil data client pertama
        } else {
          // Tangani jika tidak ada data
          _clientData = {};
        }
        _isLoading = false;
      });
    } catch (e) {
      Get.snackbar(
        'Error',
        e.toString(),
        backgroundColor: Colors.redAccent,
        colorText: Colors.white,
        snackPosition: SnackPosition.BOTTOM,
      );
      setState(() {
        _isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: _isLoading
            ? Center(child: CircularProgressIndicator())
            : Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Header
                  ClipRRect(
                    borderRadius: const BorderRadius.only(
                      bottomLeft: Radius.circular(20),
                      bottomRight: Radius.circular(20),
                    ),
                    child: Container(
                      color: const Color.fromARGB(255, 96, 121, 100),
                      padding: const EdgeInsets.all(18.0),
                      child: Column(
                        children: [
                          Row(
                            children: [
                              IconButton(
                                icon: const Icon(Icons.arrow_back,
                                    color: Colors.white),
                                onPressed: () {
                                  Navigator.pop(
                                      context); // Kembali ke halaman sebelumnya
                                },
                              ),
                              const SizedBox(width: 8),
                              Text(
                                'Profile',
                                style: GoogleFonts.poppins(
                                  fontSize: 20,
                                  fontWeight: FontWeight.bold,
                                  color: Colors.white,
                                ),
                              ),
                              const Spacer(),
                              Image.asset(
                                'assets/images/logos.png', // Logo di kanan atas
                                width: 70,
                                height: 70,
                              ),
                            ],
                          ),
                          const SizedBox(height: 16),
                          CircleAvatar(
                            radius: 40,
                            backgroundColor: Colors.white,
                            child: const Icon(
                              Icons.person,
                              size: 60,
                              color: Color(0xFF0A3047),
                            ),
                          ),
                          const SizedBox(height: 8),
                          Text(
                            _clientData.isNotEmpty
                                ? _clientData['name'] ?? 'No Name'
                                : 'Loading...',
                            style: GoogleFonts.poppins(
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                          Text(
                            _clientData.isNotEmpty &&
                                    _clientData['user'] != null
                                ? _clientData['user']['email'] ?? 'No Email'
                                : 'Loading...',
                            style: GoogleFonts.poppins(
                              fontSize: 14,
                              color: Colors.white,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),

                  const SizedBox(height: 16),
                  // Konten Profile
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 16.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        _buildProfileDetail(
                          icon: Icons.phone,
                          title: 'Nomor Telpon',
                          value: _clientData.isNotEmpty
                              ? _clientData['phone'] ?? 'No Phone'
                              : 'Loading...',
                        ),
                        const SizedBox(height: 16),
                        _buildProfileDetail(
                          icon: Icons.email,
                          title: 'Email',
                          value: _clientData.isNotEmpty
                              ? _clientData['user']['email'] ?? 'No Email'
                              : 'Loading...',
                        ),
                        const SizedBox(height: 16),
                        _buildProfileDetail(
                          icon: Icons.location_on,
                          title: 'Address',
                          value: _clientData.isNotEmpty
                              ? _clientData['address'] ?? 'No Address'
                              : 'Loading...',
                        ),
                      ],
                    ),
                  ),
                ],
              ),
      ),
    );
  }

  // Widget untuk menampilkan detail profil
  Widget _buildProfileDetail(
      {required IconData icon, required String title, required String value}) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Icon(icon, size: 24, color: const Color(0xFF0A3047)),
        const SizedBox(width: 12),
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              title,
              style: GoogleFonts.poppins(
                fontSize: 14,
                fontWeight: FontWeight.bold,
                color: Colors.black,
              ),
            ),
            Text(
              value,
              style: GoogleFonts.poppins(
                fontSize: 14,
                color: const Color(0xFF4A4A4A),
              ),
            ),
          ],
        ),
      ],
    );
  }
}
