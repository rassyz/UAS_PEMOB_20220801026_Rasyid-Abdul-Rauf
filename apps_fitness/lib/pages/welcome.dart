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
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        width: double.infinity,
        height: double.infinity,
        color: const Color(0xFF042558),
        child: Center(
          child: Image.asset(
            'assets/images/logo.png',
            width: 150,
            height: 150,
          ),
        ),
      ),
    );
  }
}
