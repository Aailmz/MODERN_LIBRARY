import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';

class PopulerComponent extends StatelessWidget {
  const PopulerComponent({super.key});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.all(18),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            margin: EdgeInsets.only(bottom: 10),
            child: Text(
              "Populer",
              style: TextStyle(
                fontSize: 30,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
          Container(
            height: MediaQuery.of(context).size.height / 3, // Increased height
            width: MediaQuery.of(context).size.width,
            child: Scrollbar(
              child: ListView.builder(
                padding: EdgeInsets.all(10),
                scrollDirection: Axis.horizontal,
                itemCount: 6,
                physics: BouncingScrollPhysics(),
                itemBuilder: (context, index) {
                  return Container(
                    width: MediaQuery.of(context).size.width / 2.5,
                    padding: EdgeInsets.all(10),
                    margin: EdgeInsets.symmetric(horizontal: 5),
                    child: Column(
                      children: [
                        Expanded(
                          child: Image.asset(
                            "images/dilan.png",
                            fit: BoxFit.cover,
                          ),
                        ),
                        SizedBox(height: 13),
                        Text(
                          "Dilan 1990",
                          style: TextStyle(
                            fontSize: 15,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        Text(
                          "Mio Mirza",
                          style: TextStyle(
                            fontSize: 10,
                            color: Colors.grey,
                          ),
                        )
                      ],
                    ),
                  );
                },
              ),
            ),
          ),
        ],
      ),
    );
  }
}
