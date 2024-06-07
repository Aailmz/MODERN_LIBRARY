<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Notification;
use App\Models\Log;
use App\Models\Loan;
use App\Models\Categories;
use App\Models\Mail;
use App\Models\Bookmark;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class BookController extends Controller
{
    public function searchBook(Request $request)
    {
        $query = $request->input('query');
        $offlineBooks = Book::where('title', 'LIKE', "%$query%")->get();

        $userId = auth()->id();

        $onlineBooks = Book::where('type', 'online')->get();
        $categories = Categories::all();
        $unreadmail = Mail::where('mail_status', 'Unread')->where('user_id', $userId)->get();

        return view('userhome', [
            'offlineBooks' => $offlineBooks,
            'onlineBooks' => $onlineBooks,
            'categories' => $categories,
            'unreadmail' => $unreadmail,
        ]);
    }

    public function getBookmark()
    {
        $userId = auth()->id();
        // Fetch mails sorted by created_at in descending order
        $bookmarks = Bookmark::where('user_id', $userId)->get();
        $unreadmail = Mail::where('mail_status', 'Unread')->where('user_id', $userId)->get();

        return view('userbookmark', ['bookmarks' => $bookmarks, 'unreadmail' => $unreadmail]);
    }

    public function mailDetail(Request $request)
    {
        $mailId = $request->query('mailId');
        $mail = Mail::findOrFail($mailId);

        return view('usermaildetail', ['mail' => $mail]);
    }


    public function getMail()
    {
        $userId = auth()->id();
        // Fetch mails sorted by created_at in descending order
        $mails = Mail::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('usermail', ['mails' => $mails]);
    }


    public function unreadMail()
    {
        $userId = auth()->id();
        $unreadmail = Mail::where('mail_status', 'Unread')->where('user_id', $userId)->get();
        return response()->json(['unreadmail' => $unreadmail]);
    }


    public function getCategories()
    {
        $categories = Categories::all();
        return response()->json(['categories' => $categories]);
    }

    public function getNotification()
    {
        $notifications = Notification::all();
        return view('tablerequest', ['notifications' => $notifications]);
    }

    public function getLoan()
    {
        $loans = Loan::all()->map(function ($loan) {
            $loan->status = Carbon::parse($loan->borrow_duration)->isPast() ? 'LATE' : 'ON TIME';
            return $loan;
        });
        return view('tableloan', ['loans' => $loans]);
    }

    public function getUserLog()
    {
        // Assuming you're using Laravel's authentication system
        $userId = auth()->id();

        // Fetch logs where user_id matches
        $logs = Log::where('user_id', $userId)->get();

        // Eager load the associated book information
        $logs->load('book');

        $unreadmail = Mail::where('mail_status', 'Unread')->where('user_id', $userId)->get();

        return view('userlog', ['logs' => $logs, 'unreadmail' => $unreadmail]);
    }


    public function getLog()
    {
        $logs = Log::all();
        return view('tablelog', ['logs' => $logs]);
    }

    public function getAdminLog()
    {
        $logs = Log::all();
        return view('historyadmin', ['logs' => $logs]);
    }

    public function tableOfflineBook()
    {
        $offlineBooks = Book::where('type', 'offline')->get();
        return view('tablebook', ['offlineBooks' => $offlineBooks]);
    }

    public function tableOnlineBook()
    {
        $onlineBooks = Book::where('type', 'online')->get();
        return view('tablebook', ['onlineBooks' => $onlineBooks]);
    }

    public function tableBook()
    {
        $offlineBooks = Book::where('type', 'offline')->get();
        $onlineBooks = Book::where('type', 'online')->get();
        $categories = Categories::all();
        return view('tablebook', ['offlineBooks' => $offlineBooks, 'onlineBooks' => $onlineBooks, 'categories' => $categories]);
    }

    //MOBILE
    public function getOfflineMobile()
    {
        $books = Book::where('type', 'offline')->get();
        return response()->json(['books' => $books]);
    }

    public function getMailsMobile($userId)
    {
        $mails = Mail::where('user_id', $userId)->get();
        return response()->json(['mails' => $mails]);
    }

    public function getNotificationsMobile($userId)
    {
        $notifications = Notification::where('user_id', $userId)->get();
        return response()->json(['notifications' => $notifications]);
    }

    public function getLoansMobile($userId)
    {
        $loans = Loan::where('user_id', $userId)->get();
        return response()->json(['loans' => $loans]);
    }

    public function getCover($file)
    {
        $path = $file;
        return response()->file(public_path("/storage/" .$path));
    }

    public function showCover()
    {
        // Assuming images are stored in the storage/app/public/images directory
        $imagePath = public_path('/storage/book_picture/5nntzlLghM6ZWmtyfOC4PEnmk7tuayupktfrDC5v.png');

        // Check if the image file exists
        if (file_exists($imagePath)) {
            // Return the image with appropriate headers
            return response()->file($imagePath);
        } else {
            // Return a default image or a 404 response if the image is not found
            abort(404);
        }
    }

    public function applyBorrow(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_duration' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Fetch additional book information
        $book = Book::find($request->book_id);

        // Create a notification entry
        Notification::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'title' => $request->title,
            'category' => $request->category,
            'name' => $request->name,
            'email' => $request->email,
            'borrow_duration' => $request->borrow_duration,
            
        ]);

        return response()->json(['success' => 'Borrow request submitted successfully!']);
    }

    //

    public function createbook(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'writer' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'language' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string', 'max:10000'],
            'page' => ['required', 'integer'],
            'stock' => ['nullable', 'integer'],
            'like' => ['nullable', 'integer'],
            'book_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'book_file' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        if ($request->hasFile('book_picture')) {
            $bookPicturePath = $request->file('book_picture')->store('public');
            $bookPicturePath = str_replace('public/', '', $bookPicturePath);
        } else {
            $bookPicturePath = null;
        }
        

        
        if ($request->hasFile('book_file')) {
            $bookFilePath = $request->file('book_file')->store('public');
        } else {
            $bookFilePath = null;
        }

        $book = Book::create([
            'title' => $request->title,
            'writer' => $request->writer,
            'publisher' => $request->publisher,
            'category' => $request->category,
            'type' => $request->type,
            'stock' => $request->stock,
            'page' => $request->page,
            'language' => $request->language,
            'rate' => $request->rate,
            'like' => '0',
            'sinopsis' => $request->sinopsis,
            'book_picture' => $bookPicturePath,
            'book_file' => $bookFilePath,

        ]);

        return response()->json(['success' => 'Book created successfully']);
    }

    public function update(Request $request)
    {
        $book = Book::find($request->id);
        
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        
        // Validate the request
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'writer' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'stock' => ['nullable', 'integer'],
            'language' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string', 'max:10000'],
            'page' => ['required', 'integer'],
            'book_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'book_file' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        // Update book data
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->publisher = $request->publisher;
        $book->category = $request->category;
        $book->type = $request->type;
        $book->stock = $request->stock;
        $book->rate = $request->rate;
        $book->page = $request->page;
        $book->language = $request->language;
        $book->sinopsis = $request->sinopsis;

        // Check if book_picture file is provided and delete the old one
        if ($request->hasFile('book_picture')) {
            $book->book_picture = $request->file('book_picture')->store('public');
        }

        if ($request->hasFile('book_file')) {
            $book->book_file = $request->file('book_file')->store('public');
        }

        $book->save();
        
        return response()->json(['success' => 'Book updated successfully', 'book' => $book]);
    }

    public function delete(Request $request)
    {
        $book = Book::find($request->id);
        
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $book->delete();
        
        return response()->json(['success' => 'Book deleted successfully', 'book' => $book]);
    }

    //CATEGORY


    public function createCategory(Request $request)
    {
        $request->validate([
            'category' => ['required', 'string', 'max:255'],
        ]);

        $category = Categories::create([

            'category' => $request->category,

        ]);

        return response()->json(['success' => 'Book created successfully']);
    }

    public function deleteCategory(Request $request)
    {
        $categories = Categories::find($request->id);
        
        if (!$categories) {
            return response()->json(['error' => 'Cat not found'], 404);
        }

        $categories->delete();
        
        return response()->json(['success' => 'Cat deleted successfully', 'category' => $categories]);
    }

    //USER HOME
    public function homeUser()
    {
        $userId = auth()->id();
        // Retrieve offline and online books, and categories
        $offlineBooks = Book::where('type', 'offline')->get();
        $onlineBooks = Book::where('type', 'online')->get();
        $categories = Categories::all();
        $unreadmail = Mail::where('mail_status', 'Unread')->where('user_id', $userId)->get();

        // Return the view with all the necessary data
        return view('userhome', [
            'offlineBooks' => $offlineBooks,
            'onlineBooks' => $onlineBooks,
            'categories' => $categories,
            'unreadmail' => $unreadmail,
        ]);
    }

    public function checkBorrowStatus(Request $request)
    {
        $userId = auth()->id();
        $bookId = $request->book_id;

        $existingLoan = Loan::where('user_id', $userId)->where('book_id', $bookId)->first();
        $existingNotification = Notification::where('user_id', $userId)->where('book_id', $bookId)->first();

        $exists = $existingLoan || $existingNotification;

        return response()->json([
            'exists' => $exists
        ]);
    }

    public function loanUser()
    {
        // Get the authenticated user's ID
        $userId = auth()->id();

        $waiting = Notification::where('user_id', $userId)->with('book')->get();
        // Retrieve loans only for the authenticated user and eager load the book details
        $loans = Loan::where('user_id', $userId)
            ->with('book') // Eager load the related book
            ->get()
            ->map(function ($loan) {
                // Set the status of the loan based on the borrow duration
                $loan->status = Carbon::parse($loan->borrow_duration)->isPast() ? 'LATE' : 'APPROVED';
                return $loan;
            });

        // Filter the loans to include only those that are late
        $lateLoans = $loans->filter(function ($loan) {
            return $loan->status === 'LATE';
        });

        $unreadmail = Mail::where('mail_status', 'Unread')->where('user_id', $userId)->get();

        // Return the view with all the necessary data
        return view('userloan', [
            'loans' => $loans,
            'lateLoans' => $lateLoans,
            'waiting' => $waiting,
            'unreadmail' => $unreadmail,
        ]);
    }


    public function detailBook($id)
    {
        $book = Book::findOrFail($id);
        return view('detailbook', compact('book'));
    }
    
    public function applyForBorrow(Request $request)
    {
        // Creating a notification entry
        Notification::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'title' => Book::find($request->book_id)->title, // Assuming you need the book title
            'category' => Book::find($request->book_id)->category, // Assuming you need the book category
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'borrow_duration' => $request->borrow_duration,
        ]);

        return response()->json(['success' => 'Borrow request submitted successfully!']);
    }

    public function acceptNotification(Request $request)
    {
        $notificationId = $request->input('id');

        // Retrieve the notification
        $notification = Notification::find($notificationId);

        if ($notification) {
            // Add entry to loan table
            Loan::create([
                'user_id' => $notification->user_id,
                'book_id' => $notification->book_id,
                'name' => $notification->name,
                'email' => $notification->email,
                'title' => $notification->title,
                'category' => $notification->category,
                'request_date' => $notification->created_at,
                'borrow_duration' => $notification->borrow_duration,
                'status' => 'ON TIME'
            ]);

            // Update stock value in books table
            $book = Book::find($notification->book_id);
            if ($book) {
                $book->stock -= 1;
                $book->save();
            }

            Mail::create([
                'user_id' => $notification->user_id,
                'book_id' => $notification->book_id,
                'name' => $notification->name,
                'title' => $notification->title,
                'date' => $notification->created_at,
                'borrow_duration' => $notification->borrow_duration,
                'status' => 'Approved',
                'condition' => 'Approved', 
                'header' => "Dear {$notification->name}, Your loan to '{$notification->title}' at {$notification->created_at} is approved.",
                'note' => "Dear {$notification->name}, Your loan to '{$notification->title}' at {$notification->created_at} until {$notification->borrow_duration} is approved. Pick up the book by accompanying proof of this mail to the library within a maximum of 2 days after this mail is sent. Thank you.",
                'mail_status' => 'Unread',
            ]);

            // Delete the notification
            $notification->delete();

            return response()->json(['success' => true, 'message' => 'Notification accepted, loan recorded, and book stock updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found.']);
    }

    public function rejectNotification(Request $request)
    {
        $notificationId = $request->input('id');

        // Retrieve the notification
        $notification = Notification::find($notificationId);
        $condition = $request->input('condition');
        $note = $request->input('note');

        if ($notification) {
            // Create a log entry
            Log::create([
                'user_id' => $notification->user_id,
                'book_id' => $notification->book_id,
                'name' => $notification->name,
                'email' => $notification->email,
                'title' => $notification->title,
                'category' => $notification->category,
                'date' => $notification->created_at,
                'borrow_duration' => $notification->borrow_duration,
                'status' => 'Rejected',
                'condition' => $condition, 
                'note' => $note,
            ]);

            // Add an entry to the mail table
            Mail::create([
                'user_id' => $notification->user_id,
                'book_id' => $notification->book_id,
                'name' => $notification->name,
                'title' => $notification->title,
                'date' => $notification->created_at,
                'borrow_duration' => $notification->borrow_duration,
                'status' => 'Rejected',
                'condition' => $condition, 
                'header' => "Dear {$notification->name}, Your loan to '{$notification->title}' at {$notification->created_at} has been rejected.",
                'note' => "Dear {$notification->name}, Your loan to '{$notification->title}' at {$notification->created_at} until {$notification->borrow_duration} has been rejected. {$note}. Thank you.",
                'mail_status' => 'Unread',
            ]);

            // Delete the notification
            $notification->delete();

            return response()->json(['success' => true, 'message' => 'Notification rejected, logged, and mail queued successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found.']);
    }

    public function updateMailStatus(Request $request, $mailId)
    {
        $mail = Mail::findOrFail($mailId);
        $mail->mail_status = 'Readed'; // Assuming the status field is named 'mail_status' and the desired status is 'Read'
        $mail->save();

        return response()->json(['message' => 'Mail status updated successfully.']);
    }


    public function returnedBook(Request $request)
    {
        $loanId = $request->input('id');

        // Retrieve the notification
        $loan = Loan::find($loanId);
        $condition = $request->input('condition');
        $note = $request->input('note');

        if ($loan) {
            // Create a log entry
            Log::create([
                'user_id' => $loan->user_id,
                'book_id' => $loan->book_id,
                'name' => $loan->name,
                'email' => $loan->email,
                'title' => $loan->title,
                'category' => $loan->category,
                'date' => $loan->created_at,
                'borrow_duration' => $loan->borrow_duration,
                'status' => 'Returned',
                'condition' => $condition, 
                'note' => $note,

            ]);

            $book = Book::find($loan->book_id);
            if ($book) {
                $book->stock += 1;
                $book->save();
            }

            Mail::create([
                'user_id' => $loan->user_id,
                'book_id' => $loan->book_id,
                'name' => $loan->name,
                'title' => $loan->title,
                'date' => $loan->created_at,
                'borrow_duration' => $loan->borrow_duration,
                'status' => 'Returned',
                'condition' => $condition, 
                'header' => "Dear {$loan->name}, You have returned '{$loan->title}'.",
                'note' => "Dear {$loan->name}, Thank you for returning '{$loan->title}' from {$loan->created_at} until {$loan->borrow_duration}. We received the book in {$condition} condition. {$note}. Thank you.",
                'mail_status' => 'Unread',
            ]);

            // Delete the notification
            $loan->delete();

            return response()->json(['success' => true, 'message' => 'Loan rejected and logged successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Loan not found.']);
    }

    public function addBookmark(Request $request)
    {
        // Creating a bookmark entry
        Bookmark::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'title' => Book::find($request->book_id)->title, // Assuming you need the book title
            'name' => auth()->user()->name,
        ]);

        return response()->json(['success' => 'Bookmark added successfully!']);
    }

    // Route


    // Controller method
    public function checkBookmarkStatus(Request $request)
    {
        $userId = auth()->id();
        $bookId = $request->book_id;

        $existingBookmark = Bookmark::where('user_id', $userId)->where('book_id', $bookId)->exists();

        return response()->json([
            'exists' => $existingBookmark
        ]);
    }

    public function deleteBookmark(Request $request)
    {
        $userId = auth()->id();
        $bookId = $request->book_id;

        Bookmark::where('user_id', $userId)->where('book_id', $bookId)->delete();

        return response()->json(['success' => true]);
    }



}
