import 'package:flutter/material.dart';
import 'api_service.dart';
import 'page/home_page.dart'; // Make sure the path is correct

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _formKey = GlobalKey<FormState>();
  final AuthenticationService _authService = AuthenticationService();

  String _email = '';
  String _password = '';
  bool _loading = false;

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        body: Container(
          decoration: BoxDecoration(
            image: DecorationImage(
              image: AssetImage('images/background.jpg'), // Ganti dengan path gambar Anda
              fit: BoxFit.cover,
            ),
          ),
          child: Center(
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Form(
                key: _formKey,
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const SizedBox(height: 200), // Mengatur jarak untuk menurunkan teks
                    RichText(
                      textAlign: TextAlign.center,
                      text: TextSpan(
                        children: [
                          TextSpan(
                            text: 'Library',
                            style: TextStyle(
                              color: Color(0xFF8ADDC9),
                              fontSize: 35,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          TextSpan(
                            text: ' - Sign In',
                            style: TextStyle(
                              color: Colors.black,
                              fontSize: 35,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ],
                      ),
                    ),
      
                    const SizedBox(height: 40),
                    TextFormField(
                      decoration: InputDecoration(
                        labelText: 'Email',
                        border: OutlineInputBorder(),
                        filled: true,
                        fillColor: Colors.white70,
                      ),
                      validator: (value) {
                      if (value!.isEmpty) {
                        return 'Please enter an email';
                      }
                      return null;
                    },
                    onSaved: (value) => _email = value!,
                    ),
                    const SizedBox(height: 20),
                    TextFormField(
                      decoration: InputDecoration(
                        labelText: 'Password',
                        border: OutlineInputBorder(),
                        filled: true,
                        fillColor: Colors.white70,
                      ),
                      obscureText: true,
                      validator: (value) {
                      if (value!.isEmpty) {
                        return 'Please enter a password';
                      }
                      return null;
                    },
                    onSaved: (value) => _password = value!,
                    ),
                    const SizedBox(height: 20),
                    Container(
                      width: double.infinity,
                      height: 50.0, // Set your desired height here
                      child: ElevatedButton(
                        onPressed: _loading ? null : _login,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Color(0xFF8ADDC9), // Set the background color to green
                          padding: EdgeInsets.symmetric(vertical: 10.0),
                        ),
                        child: const Text(
                          'Sign In',
                          style: TextStyle(fontSize: 15.0),
                        ),
                      ),
                    ),
      
                    Container(
                      height: 50.0, // Set your desired height here
                      child: TextButton(
                        onPressed: () {
                          // Aksi untuk tombol "Back" di sini
                        },
                        style: TextButton.styleFrom(
                          foregroundColor: Color.fromARGB(255, 135, 61, 255), // Set the text color to green
                          textStyle: TextStyle(fontSize: 15.0),
                        ),
                        child: const Text(
                          'Didnt have account? Sign Up',
                          style: TextStyle(fontSize: 15.0),
                        ),
                      ),
                    ),
      
      
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Future<void> _login() async {
  if (_formKey.currentState!.validate()) {
    setState(() => _loading = true);
    _formKey.currentState!.save();

    try {
      final user = await _authService.login(_email, _password);
      print('User: $user');
      // Handle user roles here
      if (user.role == 'admin' || user.role == 'petugas') {
        _showNotification('Access Denied', 'Admins and Petugas cannot log in from here.');
      } else if (user.role == 'siswa') {
        print('sukses');
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => HomePage(user: user)),
        );
      }
    } catch (e) {
      _showNotification('Login Failed', 'Invalid email or password.');
    }

    setState(() => _loading = false);
  }
}


  void _showNotification(String title, String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text(title),
          content: Text(message),
          actions: [
            TextButton(
              child: Text('OK'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }
}


