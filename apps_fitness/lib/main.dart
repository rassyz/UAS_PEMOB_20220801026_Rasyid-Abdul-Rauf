import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import 'routes/route.dart';
// import 'services/api_service.dart';
// import 'package:get_storage/get_storage.dart';
import 'package:shared_preferences/shared_preferences.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // Inisialisasi SharedPreferences sebelum menjalankan aplikasi
  await SharedPreferences.getInstance();

  // Get.put(ApiService()); // Inisialisasi ApiService dengan GetX

  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Flutter GetX Routing',
      theme: ThemeData(
        textTheme: GoogleFonts.poppinsTextTheme(),
      ),
      initialRoute: AppRoutes.WELCOME,
      getPages: AppRoutes.routes,
    );
  }
}
