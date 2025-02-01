import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../routes/route.dart';

class WelcomePage extends StatefulWidget {
  @override
  _WelcomePageState createState() => _WelcomePageState();
}

class _WelcomePageState extends State<WelcomePage> {
  @override
  void initState() {
    super.initState();

    Future.delayed(Duration(seconds: 3), () {
      Get.offNamed(AppRoutes.AUTH);
    });
  }

  @override

  /// The screen transitions to the auth screen after 3 seconds.
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        width: double.infinity,
        height: double.infinity,
        color: const Color.fromARGB(255, 96, 121, 100),
        child: Center(
          child: Image.asset(
            'assets/images/logos.png',
            width: 150,
            height: 150,
          ),
        ),
      ),
    );
  }
}
