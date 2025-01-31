import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import '../services/api_service.dart';
import '../routes/route.dart';
import 'profile.dart';
import 'pertandingan.dart';
import 'ranking.dart';

class DashboardPage extends StatefulWidget {
  @override
  _DashboardPageState createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {
  final ApiService _apiService = Get.find();
  bool _isLoading = true;
  List<dynamic> _pelatihans = [];
  String userName = "";
  String userEmail = "";

  @override
  void initState() {
    super.initState();
    _fetchPelatihans(); // Ambil data pelatihan saat halaman dimuat
    _fetchUserData(); // Ambil data user saat halaman dimuat
  }

  // Fungsi untuk mengambil data pelatihan dari API
  Future<void> _fetchPelatihans() async {
    try {
      final pelatihans = await _apiService.fetchPelatihans();
      setState(() {
        _pelatihans = pelatihans;
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

  // Fungsi untuk mengambil data user
  Future<void> _fetchUserData() async {
    try {
      final userData =
          await _apiService.fetchUser(); // Ambil data user berdasarkan token
      setState(() {
        userName = userData['name']; // Mengambil nama user
        userEmail = userData['email']; // Mengambil email user
      });
    } catch (e) {
      Get.snackbar(
        'Error',
        e.toString(),
        backgroundColor: Colors.redAccent,
        colorText: Colors.white,
        snackPosition: SnackPosition.BOTTOM,
      );
    }
  }

  // Fungsi untuk logout
  Future<void> _logout() async {
    await _apiService.logout(); // Logout dari ApiService
    Get.offAllNamed(AppRoutes.LOGIN); // Arahkan ke halaman login
  }

  @override
  Widget build(BuildContext context) {
    double screenHeight = MediaQuery.of(context).size.height;
    double screenWidth = MediaQuery.of(context).size.width;

    return Scaffold(
      backgroundColor: Colors.white,
      endDrawer: _buildDrawer(context),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Padding(
                padding:
                    const EdgeInsets.symmetric(horizontal: 8.0, vertical: 14.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      children: [
                        Image.asset(
                          'assets/images/logo2.png',
                          width: 100,
                          height: 100,
                        ),
                        const Spacer(),
                        Builder(
                          builder: (context) => IconButton(
                            icon: const Icon(
                              Icons.account_circle,
                              color: Color.fromARGB(255, 74, 74, 74),
                            ),
                            iconSize: 36.0,
                            onPressed: () {
                              Scaffold.of(context).openEndDrawer();
                            },
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 8),
                    Padding(
                      padding: const EdgeInsets.only(left: 16.0),
                      child: Text(
                        'Pelatihan',
                        style: GoogleFonts.poppins(
                          fontSize: 23,
                          fontWeight: FontWeight.bold,
                          color: const Color.fromARGB(255, 74, 74, 74),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),
              _isLoading
                  ? Center(child: CircularProgressIndicator())
                  : Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16.0),
                      child: ListView.builder(
                        shrinkWrap: true,
                        physics: const NeverScrollableScrollPhysics(),
                        itemCount: _pelatihans.length,
                        itemBuilder: (context, index) {
                          final pelatihan = _pelatihans[index];
                          final client = pelatihan['client']; // Data client
                          final employee =
                              pelatihan['employee']; // Data employee (pelatih)
                          return Column(
                            children: [
                              TrainingCard(
                                title: pelatihan['name'], // Nama pelatihan
                                date: pelatihan[
                                    'tanggal_jam'], // Tanggal pelatihan
                                description: pelatihan[
                                    'description'], // Deskripsi pelatihan
                                trainer: employee['name'], // Nama pelatih
                                score: pelatihan['nilai']
                                    .toString(), // Nilai pelatihan
                                status: pelatihan[
                                    'status'], // Status pelatihan (Lulus, Scheduled, dll.)
                                clientName: client['name'], // Nama client
                              ),
                              const SizedBox(height: 16),
                            ],
                          );
                        },
                      ),
                    ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildDrawer(BuildContext context) {
    return Drawer(
      child: Container(
        color: const Color(0xFFF5F5F5),
        child: Column(
          children: [
            UserAccountsDrawerHeader(
              accountName: Text(
                userName.isNotEmpty ? userName : 'Loading...',
                style: GoogleFonts.poppins(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: const Color.fromARGB(255, 74, 74, 74),
                ),
              ),
              accountEmail: Text(
                userEmail.isNotEmpty ? userEmail : 'Loading...',
                style: GoogleFonts.poppins(
                  fontSize: 14,
                  color: const Color.fromARGB(255, 74, 74, 74),
                ),
              ),
              currentAccountPicture: CircleAvatar(
                backgroundColor: Colors.grey[200],
                child: const Icon(
                  Icons.person,
                  size: 50,
                  color: Color.fromARGB(255, 74, 74, 74),
                ),
              ),
              decoration: const BoxDecoration(
                color: Color(0xFFF5F5F5),
              ),
            ),
            _buildDrawerItem(
              icon: Icons.home,
              title: 'Home',
              color: const Color.fromARGB(255, 74, 74, 74),
              hoverColor: Colors.grey[400]!,
              onTap: () {
                Navigator.pop(context);
              },
            ),
            _buildDrawerItem(
              icon: Icons.person,
              title: 'Profile',
              color: const Color.fromARGB(255, 74, 74, 74),
              hoverColor: Colors.grey[400]!,
              onTap: () {
                Navigator.pop(context);
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => ProfilePage()),
                );
              },
            ),
            _buildDrawerItem(
              icon: Icons.sports_esports,
              title: 'Pertandingan',
              color: const Color.fromARGB(255, 74, 74, 74),
              hoverColor: Colors.grey[400]!,
              onTap: () {
                Navigator.pop(context);
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => PertandinganPage()),
                );
              },
            ),
            _buildDrawerItem(
              icon: Icons.leaderboard,
              title: 'Top Ranking',
              color: const Color.fromARGB(255, 74, 74, 74),
              hoverColor: Colors.grey[400]!,
              onTap: () {
                Navigator.pop(context);
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => RankingPage()),
                );
              },
            ),
            const Divider(),
            _buildDrawerItem(
              icon: Icons.logout,
              title: 'Logout',
              color: Colors.red,
              hoverColor: Colors.grey[400]!,
              onTap: _logout, // Memanggil fungsi logout
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildDrawerItem({
    required IconData icon,
    required String title,
    required Color color,
    required Color hoverColor,
    required VoidCallback onTap,
  }) {
    return InkWell(
      onTap: onTap,
      splashColor: hoverColor,
      child: ListTile(
        leading: Icon(icon, color: color),
        title: Text(
          title,
          style: GoogleFonts.poppins(
            fontSize: 14,
            fontWeight: FontWeight.bold,
            color: color,
          ),
        ),
      ),
    );
  }
}

class TrainingCard extends StatelessWidget {
  final String title;
  final String date;
  final String description;
  final String trainer;
  final String score;
  final String status;
  final String clientName;

  const TrainingCard({
    Key? key,
    required this.title,
    required this.date,
    required this.description,
    required this.trainer,
    required this.score,
    required this.status,
    required this.clientName,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.blue[50],
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            title,
            style: GoogleFonts.poppins(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              color: const Color.fromARGB(255, 74, 74, 74),
            ),
          ),
          const SizedBox(height: 4),
          Text(
            date,
            style: GoogleFonts.poppins(fontSize: 12, color: Colors.grey),
          ),
          const SizedBox(height: 8),
          Text(
            'Latihan: $description',
            style: GoogleFonts.poppins(fontSize: 14),
          ),
          Text(
            'Pelatih: $trainer',
            style: GoogleFonts.poppins(fontSize: 14),
          ),
          Text(
            'Client: $clientName',
            style: GoogleFonts.poppins(fontSize: 14),
          ),
          Text(
            'Nilai: $score',
            style: GoogleFonts.poppins(fontSize: 14),
          ),
          const SizedBox(height: 12),
          Align(
            alignment: Alignment.centerRight,
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
              decoration: BoxDecoration(
                color: status == 'Scheduled' ? Colors.blue : Colors.green,
                borderRadius: BorderRadius.circular(12),
              ),
              child: Text(
                status,
                style: GoogleFonts.poppins(
                  fontSize: 12,
                  color: Colors.white,
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
