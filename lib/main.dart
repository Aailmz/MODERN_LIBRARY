import 'package:flutter/material.dart';
import 'package:flutter_library/login.dart';
import 'api_service.dart';

void main() {
  runApp(MaterialApp(
    home: LoginPage(),
  ));
}

class MainApp extends StatelessWidget {
  const MainApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        body: LoginPage(),
      ),
    );
  }
}
