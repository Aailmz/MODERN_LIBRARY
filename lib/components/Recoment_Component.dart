import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter_library/api_service.dart';

class RecommendationComponent extends StatefulWidget {
  const RecommendationComponent({super.key});

  @override
  State<RecommendationComponent> createState() =>
      _RecommendationComponentState();
}

class _RecommendationComponentState extends State<RecommendationComponent> {
  final PageController _pageController = PageController(viewportFraction: 0.8);
  double _currentPage = 0.0;
  late Future<List<Book>> _futureBooks;

  @override
  void initState() {
    super.initState();
    _futureBooks = BookApi.fetchBooks();
    _pageController.addListener(() {
      setState(() {
        _currentPage = _pageController.page!;
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    double screenWidth = MediaQuery.of(context).size.width;

    return Padding(
      padding: EdgeInsets.all(18),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          Container(
            alignment: Alignment.centerLeft,
            child: Text(
              "Recommendation",
              style: TextStyle(
                fontSize: 30,
              ),
            ),
          ),
          SizedBox(
            height: MediaQuery.of(context).size.height / 4,
            child: FutureBuilder<List<Book>>(
              future: _futureBooks,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  return Center(child: Text('Error: ${snapshot.error}'));
                } else {
                  final List<Book> books = snapshot.data!;
                  return PageView.builder(
                    controller: _pageController,
                    itemCount: books.length,
                    itemBuilder: (context, index) {
                      final Book book = books[index];
                      return Transform.scale(
                        scale: _currentPage.round() == index ? 1.0 : 0.9,
                        child: InkWell(
                          onTap: () => Navigator.pushNamed(context, "detail"),
                          child: Card(
                            elevation: 0,
                            child: Container(
                              margin: EdgeInsets.symmetric(horizontal: 10),
                              decoration: BoxDecoration(
                                color: Colors.transparent,
                              ),
                              child: Column(
                                children: [
                                  Text(
                                    book.title,
                                    style: TextStyle(
                                      color: Color(0xFF342066),
                                      fontSize: 18,
                                    ),
                                  ),
                                  Text(
                                    'By ${book.writer}',
                                    style: TextStyle(color: Colors.grey, fontSize: 15),
                                  ),
                                ],
                              ),
                            ),
                          ),
                        ),
                      );
                    },
                  );
                }
              },
            ),
          ),
        ],
      ),
    );
  }
}