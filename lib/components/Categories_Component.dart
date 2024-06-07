import 'package:flutter/material.dart';
import 'package:flutter_library/api_service.dart';
import 'package:flutter_library/components/SearchComponent.dart';
import 'package:flutter_library/page/detail_page.dart';

class CategoriesComponent extends StatefulWidget {

  final User user;
  const CategoriesComponent({Key? key, required this.user}) : super(key: key);

  @override
  _CategoriesComponentState createState() => _CategoriesComponentState();
}

class _CategoriesComponentState extends State<CategoriesComponent> {
  late Future<List<Book>> _futureBooks;

  @override
  void initState() {
    super.initState();
    _futureBooks = BookApi.fetchBooks();
  }

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(18.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SearchComponent(),
          SizedBox(height: 10.0),
          Container(
            margin: const EdgeInsets.only(bottom: 10),
            child: const Text(
              "Recommendation",
              style: TextStyle(
                fontSize: 30,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
          Container(
            height: MediaQuery.of(context).size.height / 5,
            child: FutureBuilder<List<Book>>(
              future: _futureBooks,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  return Center(child: Text('Error: ${snapshot.error}'));
                } else {
                  final List<Book> books = snapshot.data!;
                  return Scrollbar(
                    child: ListView.builder(
                      scrollDirection: Axis.horizontal,
                      itemCount: books.length,
                      physics: const BouncingScrollPhysics(),
                      itemBuilder: (context, index) {
                        final book = books[index];
                        return GestureDetector(
                          onTap: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                builder: (context) => DetailPage(book: book, user: widget.user),
                              ),
                            );
                          },
                          child: Container(
                            padding: const EdgeInsets.all(1),
                            margin: const EdgeInsets.symmetric(horizontal: 5),
                            width: 150,
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(10),
                              boxShadow: [
                                BoxShadow(
                                  color: Colors.black.withOpacity(0.1),
                                  spreadRadius: 2,
                                  blurRadius: 5,
                                  offset: Offset(0, 3),
                                ),
                              ],
                            ),
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              crossAxisAlignment: CrossAxisAlignment.center,
                              children: [
                                Image.network(
                                  book.imageUrl,
                                  width: 100, // Set your desired width
                                  height: 110, // Set your desired height
                                  fit: BoxFit.cover, // Adjust this based on your image aspect ratio requirements
                                ),
                                const SizedBox(height: 5),
                                Text(
                                  book.title,
                                  style: const TextStyle(fontSize: 15),
                                  textAlign: TextAlign.center,
                                ),
                                const SizedBox(height: 5),
                                Text(
                                  book.writer,
                                  style: const TextStyle(fontSize: 10, color: Colors.grey),
                                  textAlign: TextAlign.center,
                                ),
                              ],
                            ),
                          ),
                        );
                      },
                    ),
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
