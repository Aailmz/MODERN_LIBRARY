import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_library/components/Detail_Component.dart';
import 'package:flutter_library/api_service.dart';

class DetailPage extends StatelessWidget {
  final Book book;
  final User user;

  DetailPage({required this.book, required this.user});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: CustomScrollView(
        slivers: [
          SliverAppBar(
            pinned: true,
            expandedHeight: MediaQuery.of(context).size.height / 2,
            flexibleSpace: FlexibleSpaceBar(
              background: ClipRRect(
                borderRadius: BorderRadius.only(
                  bottomLeft: Radius.circular(90),
                  bottomRight: Radius.circular(90),
                ),
                child: Image.network(
                  book.imageUrl, // Display the book's image
                  fit: BoxFit.cover,
                ),
              ),
            ),
            backgroundColor: Colors.transparent,
            elevation: 0,
            toolbarHeight: AppBar().preferredSize.height,
          ),
          SliverToBoxAdapter(
            child: Transform.translate(
              offset: Offset(0, -20),
              child: DetailComponent(book: book, user: user),
            ),
          ),
        ],
      ),
    );
  }
}
