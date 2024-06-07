import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_custom_clippers/flutter_custom_clippers.dart';

class WaveContainer extends StatelessWidget {
  @override
  void onPressed(BuildContext context) {
    // Fungsi yang akan dijalankan ketika tombol ditekan
    print("Button pressed!");
  }

  Widget build(BuildContext context) {
    return Align(
      alignment: Alignment.centerRight,
      child: Expanded(
        child: ClipPath(
          clipper: WaveClipperTwo(flip: true),
          child: Container(
            width: MediaQuery.of(context).size.width,
            height: MediaQuery.of(context).size.height / 9,
            decoration: BoxDecoration(
              color: Color(0xFF8ADDC9),
            ),
            child: IconButton(
              iconSize: 40,
              color: Colors.white,
              alignment: Alignment.centerRight,
              onPressed: () => onPressed(context),
              icon: Icon(
                  Icons.notifications), // Ganti dengan ikon yang Anda inginkan
            ),
          ),
        ),
      ),
    );
  }
}