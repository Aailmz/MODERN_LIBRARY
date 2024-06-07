import 'package:flutter/material.dart';
import 'package:flutter_library/api_service.dart' as myApi;
import 'package:intl/intl.dart';

class MailPage extends StatefulWidget {
  final int userId;

  MailPage({required this.userId});

  @override
  _MailPageState createState() => _MailPageState();
}

class _MailPageState extends State<MailPage> {
  late Future<List<myApi.Mail>> _futureMails;

  @override
  void initState() {
    super.initState();
    _futureMails = myApi.MailApi.fetchMails(widget.userId);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Mails'),
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(18.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              margin: const EdgeInsets.only(bottom: 10),
              child: const Text(
                "Mails",
                style: TextStyle(
                  fontSize: 30,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
            Expanded(
              child: FutureBuilder<List<myApi.Mail>>(
                future: _futureMails,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(child: Text('Error: ${snapshot.error}'));
                  } else {
                    final List<myApi.Mail> mails = snapshot.data!;
                    return ListView.builder(
                      itemCount: mails.length,
                      itemBuilder: (context, index) {
                        final mail = mails[index];
                        return Card(
                          elevation: 4.0,
                          margin: EdgeInsets.symmetric(vertical: 8.0, horizontal: 16.0),
                          child: Padding(
                            padding: EdgeInsets.all(16.0),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(
                                  mail.status,
                                  style: TextStyle(
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                                SizedBox(height: 8.0),
                                Text(
                                  'Borrow Date: ${DateFormat('yyyy-MM-dd – kk:mm').format(mail.date)}',
                                  style: TextStyle(
                                    fontSize: 14.0,
                                    color: Colors.grey[600],
                                  ),
                                ),
                                SizedBox(height: 8.0),
                                Text(
                                  'Borrow Duration: ${DateFormat('yyyy-MM-dd – kk:mm').format(mail.borrow_duration)}',
                                  style: TextStyle(
                                    fontSize: 14.0,
                                    color: Colors.grey[600],
                                  ),
                                ),
                                SizedBox(height: 8.0),
                                Text(
                                  'Condition: ${mail.condition}',
                                  style: TextStyle(
                                    fontSize: 14.0,
                                    color: Colors.grey[600],
                                  ),
                                ),
                                SizedBox(height: 8.0),
                                Text(
                                  mail.header,
                                  style: TextStyle(
                                    fontSize: 14.0,
                                    color: Colors.grey[600],
                                  ),
                                ),
                                SizedBox(height: 8.0),
                              ],
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
      ),
    );
  }
}
