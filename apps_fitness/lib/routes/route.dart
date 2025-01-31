import '../pages/welcome.dart';
import 'package:get/get.dart';
import '../pages/auth.dart';
import '../pages/dashboard.dart';
import '../pages/profile.dart';

class AppRoutes {
  static const WELCOME = '/welcome';
  static const AUTH = '/auth';
  static const DASHBOARD = '/dashboard';
  static const PROFILE = '/profile';
  static const PERTANDINGAN = '/pertandingan';

  static final routes = [
    GetPage(
      name: WELCOME,
      page: () => WelcomePage(),
    ),
    GetPage(
      name: AUTH,
      page: () => AuthPage(),
      transition: Transition.fadeIn,
      transitionDuration: Duration(milliseconds: 800),
    ),
    GetPage(
      name: DASHBOARD,
      page: () => DashboardPage(),
    ),
    GetPage(
      name: PROFILE,
      page: () => ProfilePage(),
    ),
  ];
}
