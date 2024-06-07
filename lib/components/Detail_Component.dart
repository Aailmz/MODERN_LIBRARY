import 'package:flutter/material.dart';
import 'package:flutter_library/api_service.dart';
import 'package:intl/intl.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class DetailComponent extends StatefulWidget {
  final Book book;
  final User user; // Assume you have a User model

  DetailComponent({required this.book, required this.user});

  @override
  State<DetailComponent> createState() => _DetailComponentState();
}

class _DetailComponentState extends State<DetailComponent> {
  DateTime? _selectedDate;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            widget.book.title,
            style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
          ),
          SizedBox(height: 10),
          Text(
            'By ${widget.book.writer}',
            style: TextStyle(fontSize: 18, color: Colors.grey),
          ),
          SizedBox(height: 10),
          Text(
            'Publisher: ${widget.book.publisher}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Category: ${widget.book.category}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Type: ${widget.book.type}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Stock: ${widget.book.stock}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Page: ${widget.book.page}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Language: ${widget.book.language}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Rate: ${widget.book.rate}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Synopsis: ${widget.book.sinopsis}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          Text(
            'Likes: ${widget.book.like}',
            style: TextStyle(fontSize: 16, color: Colors.grey),
          ),
          // Other book details
          SizedBox(height: 20),
          ElevatedButton(
            onPressed: () {
              _selectDate(context);
            },
            child: Text(_selectedDate == null
                ? 'Select Borrow Duration'
                : 'Borrow until ${_selectedDate.toString().substring(0, 10)}'),
          ),
          SizedBox(height: 20),
          ElevatedButton(
            onPressed: () {
              if (_selectedDate != null) {
                _applyForBorrow(context, widget.book, widget.user, _selectedDate!);
              } else {
                ScaffoldMessenger.of(context).showSnackBar(
                  SnackBar(
                    content: Text('Please select borrow duration.'),
                    duration: Duration(seconds: 3),
                  ),
                );
              }
            },
            child: Text('Borrow'),
          ),
        ],
      ),
    );
  }

  Future<void> _selectDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime.now(),
      lastDate: DateTime.now().add(Duration(days: 30)), // Limit to 30 days from now
    );

    if (picked != null) {
      setState(() {
        _selectedDate = picked;
      });
    }
  }

  void _applyForBorrow(BuildContext context, Book book, User user, DateTime borrowDuration) async {
    try {
      await BorrowApi.applyForBorrow(book, user, borrowDuration);
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Borrow request submitted successfully!'),
          duration: Duration(seconds: 3),
        ),
      );
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Failed to submit borrow request. Please try again.'),
          duration: Duration(seconds: 3),
        ),
      );
    }
  }
}

class BorrowApi {
  static Future<void> applyForBorrow(Book book, User user, DateTime borrowDuration) async {
    final url = Uri.parse('http://127.0.0.1:8000/applyborrowmobile');
    final dateFormat = DateFormat('yyyy-MM-dd HH:mm:ss');
    final formattedBorrowDuration = dateFormat.format(borrowDuration);

    final response = await http.post(
      url,
      headers: {
        'Content-Type': 'application/json',
      },
      body: jsonEncode({
        'book_id': book.id,
        'borrow_duration': formattedBorrowDuration,
        'user_id': user.id,
        'name': user.name,
        'email': user.email,
        'title': book.title,
        'category': book.category,
      }),
    );

    if (response.statusCode != 200) {
      throw Exception('Failed to submit borrow request. Please try again.');
    }
  }
}
