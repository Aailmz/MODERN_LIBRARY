import 'package:flutter/material.dart';
import 'package:flutter_library/components/Categories_Component.dart';
import 'package:flutter_library/components/loan.dart';
import 'package:flutter_library/components/mail.dart';
import 'package:flutter_library/components/waiting.dart';
import 'package:flutter_custom_clippers/flutter_custom_clippers.dart';
import 'package:flutter_library/api_service.dart';
import 'package:flutter_library/components/profile_page.dart';

class HomePage extends StatefulWidget {
  final User user;

  HomePage({required this.user});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  int _selectedIndex = 0;

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        body: SafeArea(
          child: SingleChildScrollView(
            child: Column(
              children: [
                Align(
                  alignment: Alignment.centerRight,
                  child: ClipPath(
                    clipper: WaveClipperTwo(flip: true),
                    child: Container(
                      width: MediaQuery.of(context).size.width,
                      height: MediaQuery.of(context).size.height / 9,
                      decoration: BoxDecoration(
                        color: Color(0xFF8ADDC9),
                      ),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.end,
                        children: [
                          GestureDetector(
                            onTap: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(builder: (context) => ProfilePage(user: widget.user)),
                              );
                            },
                            child: Row(
                              children: [
                                CircleAvatar(
                                  backgroundImage: NetworkImage(widget.user.profilePicture),
                                  radius: 25,
                                ),
                              ],
                            ),
                          ),
                          IconButton(
                            icon: Icon(Icons.notifications),
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(builder: (context) => MailPage(userId: widget.user.id)),
                              );
                            },
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                if (_selectedIndex == 0) CategoriesComponent(user: widget.user),
                if (_selectedIndex == 1) NotificationsPage(userId: widget.user.id),
                if (_selectedIndex == 2) LoanPage(userId: widget.user.id),
              ],
            ),
          ),
        ),
        bottomNavigationBar: BottomNavigationBar(
          currentIndex: _selectedIndex,
          onTap: (index) {
            setState(() {
              _selectedIndex = index;
            });
          },
          items: [
            BottomNavigationBarItem(
              icon: Icon(Icons.home),
              label: 'Home',
            ),
            BottomNavigationBarItem(
              icon: Icon(Icons.menu),
              label: 'Waiting',
            ),
            BottomNavigationBarItem(
              icon: Icon(Icons.book),
              label: 'Loan',
            ),
          ],
        ),
      ),
    );
  }
}
