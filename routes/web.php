<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard');

Route::get('/users', [UserController::class,'index'])
->name('users');

Route::get('/addUser', [UserController::class,'addUser'])
->name('addUser');

Route::post('/store', [StaffController::class, 'storeStaff'])
->name('storeStaff');

Route::post('/storeCustomer', [CustomerController::class, 'storeCustomer'])
->name('storeCustomer');

Route::get('/hotels', [HotelController::class, 'index'])
->name('hotels');

Route::get('/hotels2',[DestinationsController::class, 'index'])
->name('hotels2');

Route::get('/addHotel', [HotelController::class, 'addHotel'])
->name('addHotel');

Route::post('/storeHotel', [HotelController::class, 'storeHotel'])
->name('storeHotel');

Route::post('/storeImage', [HotelController::class, 'uploadImage'])
->name('uploadImage');

Route::get('/', [UserController::class, 'home'])
->name('home');

Route::get('/signin', [UserController::class, 'signInPage'])
->name('signin');

Route::post('/signUp', [UserController::class, 'signUp'])
->name('signUp');

Route::post('/login', [UserController::class, 'logIn'])
->name('logIn');

Route::post('/signIn', [UserController::class, 'signIn'])
->name('signIn');

Route::get('/logout', [UserController::class, 'logOut'])
->name('logout');

Route::get('/profile', [UserController::class, 'profile'])
->name('profile');

Route::get('/destinations', [HotelController::class, 'destinations'])
->name('destinations');

//Opens up the bookingForm page
Route::get('/book/{hotelid}/{custid}', [BookingController::class, 'book'])
->name('book');
// Route::get('/book/{hotelid?}', [BookingController::class, 'processBooking'])
// ->name('testBooking');

Route::post('/form/{hotelid}', [BookingController::class, 'getDetails'])
->name('getDetails');

Route::post('/payment/{hotelid}', [BookingController::class, 'processPayment'])
->name('processPayment');

Route::get('/test/{hotelid}', [BookingController::class, 'test'])
->name('test');

Route::get('/bookings', [BookingController::class, 'displayBookings'])
->name('bookings');

Route::view('/app', 'layouts/app')->name('app');

Route::get('post/{id}', function($id){
    return view('test',['id' => $id]);
});
#Route::post('/test1/{hotelid})
Auth::routes();

Route::view('/login', 'auth/login')
->name('login');

Route::get('/makeAdmin/{userEmail}', [StaffController::class, 'makeAdmin'])
->name('makeAdmin');

Route::get('/removeAdmin/{userEmail}', [StaffController::class, 'removeAdmin'])
->name('removeAdmin');

Route::get('/deleteStaff/{userEmail}', [StaffController::class, 'deleteStaff'])
->name('deleteStaff');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
