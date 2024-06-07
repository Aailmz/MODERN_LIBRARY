import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:intl/intl.dart';
import 'package:shared_preferences/shared_preferences.dart';

class User {
  final int id;
  final String name;
  final String email;
  final String role;
  final String profilePicture; // Add this field

  User({
    required this.id,
    required this.name,
    required this.email,
    required this.role,
    required this.profilePicture,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      role: json['role'],
      profilePicture: 'http://127.0.0.1:8000/images/' + json['profile_picture'], 
    );
  }
}

class AuthenticationService {
  final String _baseUrl = 'http://127.0.0.1:8000';

  Future<User> login(String email, String password) async {
    final url = Uri.parse('$_baseUrl/loginmobile');
    final response = await http.post(
      url,
      headers: {
        'Content-Type': 'application/json',
      },
      body: jsonEncode({'email': email, 'password': password}),
    );

    if (response.statusCode == 200) {
      final Map<String, dynamic> responseData = jsonDecode(response.body);
      final User user = User.fromJson(responseData['user']);
      return user;
    } else {
      throw Exception('Failed to login');
    }
  }
}

class ApiService {
  static const String baseUrl = 'http://127.0.0.1:8000'; // Replace with your backend URL

  Future<void> logout() async {
    final url = Uri.parse('$baseUrl/logoutmobile');
    final response = await http.post(
      url,
      headers: {
        'Content-Type': 'application/json',
      },
    );

    if (response.statusCode != 200) {
      throw Exception('Failed to log out');
    }

    // Optionally clear cookies or session data
    final prefs = await SharedPreferences.getInstance();
    prefs.remove('sessionCookie'); // Remove any session-related data if stored
  }
}


class BookApi {
  static Future<List<Book>> fetchBooks() async {
    final response = await http.get(Uri.parse('http://127.0.0.1:8000/books'));

    if (response.statusCode == 200) {
      final List<dynamic> responseData = jsonDecode(response.body)['books'];
      return responseData.map((json) => Book.fromJson(json)).toList();
    } else {
      throw Exception('Failed to fetch books');
    }
  }
}

class Book {
  final int id;
  final String title;
  final String writer;
  final String imageUrl;
  final String publisher;
  final String category;
  final String type;
  final int stock;
  final int page;
  final String language;
  final String rate;
  final String sinopsis;
  final int like;


  Book({required this.id, 
  required this.title, 
  required this.writer, 
  required this.imageUrl, 
  required this.publisher, 
  required this.category, 
  required this.type, 
  required this.stock,
  required this.page,
  required this.rate,
  required this.language,
  required this.sinopsis,
  required this.like, });
  
  factory Book.fromJson(Map<String, dynamic> json) {
    return Book(
      id: json['id'],
      title: json['title'],
      writer: json['writer'],
      publisher: json['publisher'],
      category: json['category'],
      type: json['type'],
      stock: json['stock'],
      page: json['page'],
      language: json['language'],
      rate: json['rate'],
      sinopsis: json['sinopsis'],
      like: json['like'],
      imageUrl: 'http://127.0.0.1:8000/images/' + json['book_picture'],
    );
  }

}

class Notification {
  final int id;
  final int book_id;
  final int user_id;
  final String title;
  final String category;
  final String name;
  final String email;
  final DateTime borrow_duration;


  Notification({
  required this.id, 
  required this.book_id, 
  required this.user_id, 
  required this.title, 
  required this.category, 
  required this.name, 
  required this.email, 
  required this.borrow_duration, 
   });
  
  factory Notification.fromJson(Map<String, dynamic> json) {
    return Notification(
      id: json['id'],
      book_id: json['book_id'],
      user_id: json['user_id'],
      title: json['title'],
      category: json['category'],
      name: json['name'],
      email: json['email'],
      borrow_duration: DateTime.parse(json['borrow_duration']),
    );
  }

}

class NotificationApi {
  static Future<List<Notification>> fetchNotifications(int userId) async {
    final response = await http.get(Uri.parse('http://127.0.0.1:8000/notifications/$userId'));

    if (response.statusCode == 200) {
      final List<dynamic> responseData = jsonDecode(response.body)['notifications'];
      return responseData.map((json) => Notification.fromJson(json)).toList();
    } else {
      throw Exception('Failed to fetch notifications');
    }
  }
}

class Loan {
  final int id;
  final int book_id;
  final int user_id;
  final String title;
  final String category;
  final String name;
  final String email;
  final DateTime request_date;
  final DateTime borrow_duration;
  final String status;


  Loan({
  required this.id, 
  required this.book_id, 
  required this.user_id, 
  required this.title, 
  required this.category, 
  required this.name, 
  required this.email,
  required this.request_date,
  required this.borrow_duration,
  required this.status, 
   });
  
  factory Loan.fromJson(Map<String, dynamic> json) {
    return Loan(
      id: json['id'],
      book_id: json['book_id'],
      user_id: json['user_id'],
      title: json['title'],
      category: json['category'],
      name: json['name'],
      email: json['email'],
      request_date: DateTime.parse(json['request_date']),
      borrow_duration: DateTime.parse(json['borrow_duration']),
      status: json['status'],
    );
  }
}

class LoanApi {
  static Future<List<Loan>> fetchLoans(int userId) async {
    final response = await http.get(Uri.parse('http://127.0.0.1:8000/loans/$userId'));

    if (response.statusCode == 200) {
      final List<dynamic> responseData = jsonDecode(response.body)['loans'];
      return responseData.map((json) => Loan.fromJson(json)).toList();
    } else {
      throw Exception('Failed to fetch notifications');
    }
  }
}

class Mail {
  final int id;
  final int book_id;
  final int user_id;
  final String title;
  final String name;
  final DateTime date;
  final DateTime borrow_duration;
  final String status;
  final String condition;
  final String header;
  final String note;
  final String mail_status;

  Mail({
    required this.id,
    required this.book_id,
    required this.user_id,
    required this.title,
    required this.name,
    required this.date,
    required this.borrow_duration,
    required this.status,
    required this.condition,
    required this.header,
    required this.note,
    required this.mail_status,
  });

  factory Mail.fromJson(Map<String, dynamic> json) {
    return Mail(
      id: json['id'],
      book_id: json['book_id'],
      user_id: json['user_id'],
      title: json['title'],
      name: json['name'],
      date: DateTime.parse(json['date']),
      borrow_duration: DateTime.parse(json['borrow_duration']),
      status: json['status'],
      condition: json['condition'],
      header: json['header'],
      note: json['note'],
      mail_status: json['mail_status'],
    );
  }
}

class MailApi {
  static Future<List<Mail>> fetchMails(int userId) async {
    final response = await http.get(Uri.parse('http://127.0.0.1:8000/mails/$userId'));

    if (response.statusCode == 200) {
      final List<dynamic> responseData = jsonDecode(response.body)['mails'];
      return responseData.map((json) => Mail.fromJson(json)).toList();
    } else {
      throw Exception('Failed to fetch mails');
    }
  }
}