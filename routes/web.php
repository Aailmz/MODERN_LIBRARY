<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetugasMiddleware;
use App\Http\Middleware\SiswaMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loginget', function () {
    return view('auth.loginpage');
})->name('loginget');

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

Route::get('/dashboard', [UserController::class, 'tableSiswa'])->middleware(['auth', 'verified', PetugasMiddleware::class])->name('dashboard');
Route::get('/adminstudent', [UserController::class, 'adminSiswa'])->middleware(['auth', 'verified', AdminMiddleware::class])->name('adminsiswa');
Route::get('/dashboardpetugas', [UserController::class, 'tablePetugas'])->middleware(['auth', 'verified', AdminMiddleware::class])->name('tablepetugas');
Route::get('/dashboardbook', [BookController::class, 'tableBook'])->middleware(['auth', 'verified', PetugasMiddleware::class])->name('tablebook');
Route::get('/dashboardonline', [BookController::class, 'tableOnlineBook'])->middleware(['auth', 'verified'])->name('tableonlinebook');
Route::get('/dashboardcategory', [BookController::class, 'getCategories'])->middleware(['auth', 'verified'])->name('tablecategory');
Route::get('/dashboardnotifications', [BookController::class, 'getNotification'])->middleware(['auth', 'verified', PetugasMiddleware::class])->name('tablenotification');
Route::get('/dashboardloans', [BookController::class, 'getLoan'])->middleware(['auth', 'verified', PetugasMiddleware::class])->name('tableloan');
Route::get('/dashboardlog', [BookController::class, 'getLog'])->middleware(['auth', 'verified', PetugasMiddleware::class])->name('tablelog');
Route::get('/adminlog', [BookController::class, 'getAdminLog'])->middleware(['auth', 'verified', AdminMiddleware::class])->name('adminlog');
Route::get('/dashboarduserloans', [BookController::class, 'getUserLoan'])->middleware(['auth', 'verified'])->name('tableuserloan');
Route::get('/unreadmails', [BookController::class, 'unreadMail'])->middleware(['auth', 'verified'])->name('unreadmails');
Route::get('/dashboardmails', [BookController::class, 'getMail'])->middleware(['auth', 'verified', SiswaMiddleware::class])->name('siswas.mails');
Route::get('/userlog', [BookController::class, 'getUserLog'])->middleware(['auth', 'verified', SiswaMiddleware::class])->name('userlog');
Route::get('/userbookmark', [BookController::class, 'getBookmark'])->middleware(['auth', 'verified', SiswaMiddleware::class])->name('userbookmark');
Route::get('/admin', [UserController::class, 'tablePetugas'])->middleware(['auth', 'verified', AdminMiddleware::class])->name('admins.dashboard');
Route::get('/petugas', [BookController::class, 'tableBook'])->middleware(['auth', 'verified'])->name('petugas.dashboard');
Route::get('/siswa', [BookController::class, 'homeUser'])->middleware(['auth', 'verified', SiswaMiddleware::class])->name('siswas.dashboard');
Route::get('/loan', [BookController::class, 'loanUser'])->middleware(['auth', 'verified', SiswaMiddleware::class])->name('siswas.loan');

Route::get('/mail/detail', [BookController::class, 'mailDetail'])->name('mail.detail');
Route::get('/detailbook/{id}', [BookController::class, 'detailBook'])->middleware(['auth', 'verified'])->name('detail.book');
Route::post('/check-borrow-status', [BookController::class, 'checkBorrowStatus'])->name('check-borrow-status');
Route::get('/siswa/search', [BookController::class, 'searchBook'])->name('books.search');


//MOBILE
Route::get('/userdetails', [AuthenticatedSessionController::class, 'userDetails'])->name('userdetails');
Route::get('/books', [BookController::class, 'getOfflineMobile']);
Route::get('/notifications/{userId}', [BookController::class, 'getNotificationsMobile'])->name('notificationsMobile');
Route::get('/loans/{userId}', [BookController::class, 'getLoansMobile'])->name('loansMobile');
Route::get('/mails/{userId}', [BookController::class, 'getMailsMobile'])->name('mailsMobile');
Route::get('cover/{file}', [BookController::class, 'getCover']);
Route::get('images', [BookController::class, 'showCover']);
Route::post('/applyborrowmobile', [BookController::class, 'applyBorrow'])->name('applyborrowmobile');

Route::get('images/{file}', function ($file) {

    $filePath = public_path("/storage/". $file);
    return response()->file($filePath);
});





Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profileuser', [ProfileController::class, 'editUser'])->name('profile.edituser');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profileuser', [ProfileController::class, 'updateUser'])->name('profile.updateuser');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

//API
Route::post('/create-student', [UserController::class, 'create']);
Route::post('/update-student', [UserController::class, 'update']);
Route::delete('/delete-student', [UserController::class, 'delete']);

Route::post('/create-book', [BookController::class, 'createbook']);
Route::post('/update-book', [BookController::class, 'update'])->name('update-book');
Route::delete('/delete-book', [BookController::class, 'delete']);

Route::post('/create-category', [BookController::class, 'createCategory']);
Route::delete('/delete-category', [BookController::class, 'deleteCategory']);

//BOOK
Route::post('/apply-for-borrow', [BookController::class, 'applyForBorrow'])->name('apply-for-borrow');
Route::post('/reject-notification', [BookController::class, 'rejectNotification'])->name('reject-notification');
Route::post('/accept-notification', [BookController::class, 'acceptNotification'])->name('accept-notification');
Route::post('/returned-book', [BookController::class, 'returnedBook'])->name('returned-book');
Route::put('/update-mail-status/{mailId}', [BookController::class, 'updateMailStatus']);

Route::post('/add-bookmark', [BookController::class, 'addBookmark'])->name('add-bookmark');
Route::post('/check-bookmark-status', [BookController::class, 'checkBookmarkStatus'])->name('check-bookmark-status');
Route::delete('/delete-bookmark', [BookController::class, 'deleteBookmark'])->name('delete-bookmark');
