import 'package:flutter/material.dart';
import 'package:flutter_library/api_service.dart' as myApi;
import 'package:intl/intl.dart';

class LoanPage extends StatefulWidget {
  final int userId;

  LoanPage({required this.userId});

  @override
  _LoanPageState createState() => _LoanPageState();
}

class _LoanPageState extends State<LoanPage> {
  late Future<List<myApi.Loan>> _futureLoans;

  @override
  void initState() {
    super.initState();
    _futureLoans = myApi.LoanApi.fetchLoans(widget.userId);
  }

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(18.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            margin: const EdgeInsets.only(bottom: 10),
            child: const Text(
              "Loans",
              style: TextStyle(
                fontSize: 30,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
          Container(
            height: MediaQuery.of(context).size.height / 2,
            child: FutureBuilder<List<myApi.Loan>>(
              future: _futureLoans,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  return Center(child: Text('Error: ${snapshot.error}'));
                } else {
                  final List<myApi.Loan> loans = snapshot.data!;
                  return ListView.builder(
                    itemCount: loans.length,
                    itemBuilder: (context, index) {
                      final loan = loans[index];
                      return Card(
                        elevation: 4.0,
                        margin: EdgeInsets.symmetric(vertical: 8.0, horizontal: 16.0),
                        child: Padding(
                          padding: EdgeInsets.all(16.0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                loan.title,
                                style: TextStyle(
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              SizedBox(height: 8.0),
                              Text(
                                'Category: ${loan.category}',
                                style: TextStyle(
                                  fontSize: 14.0,
                                  color: Colors.grey[600],
                                ),
                              ),
                              SizedBox(height: 8.0),
                              Text(
                                'Requested by: ${loan.name} (${loan.email})',
                                style: TextStyle(
                                  fontSize: 14.0,
                                  color: Colors.grey[600],
                                ),
                              ),
                              SizedBox(height: 8.0),
                              Text(
                                'Request Date: ${DateFormat('yyyy-MM-dd – kk:mm').format(loan.request_date)}',
                                style: TextStyle(
                                  fontSize: 14.0,
                                  color: Colors.grey[600],
                                ),
                              ),
                              SizedBox(height: 8.0),
                              Text(
                                'Borrow Duration: ${DateFormat('yyyy-MM-dd – kk:mm').format(loan.borrow_duration)}',
                                style: TextStyle(
                                  fontSize: 14.0,
                                  color: Colors.grey[600],
                                ),
                              ),
                              SizedBox(height: 8.0),
                              Text(
                                'Status: ${loan.status}',
                                style: TextStyle(
                                  fontSize: 14.0,
                                  color: Colors.grey[600],
                                ),
                              ),
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
    );
  }
}
