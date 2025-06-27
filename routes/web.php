<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('home'));
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes(['verify' => false, 'reset' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('userList');
    Route::get('/user/create', [UserController::class, 'create'])->name('createUser');
    Route::post('/user/create', [UserController::class, 'store'])->name('storeUser');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('editUser');
    Route::post('/user/edit/{user}', [UserController::class, 'update'])->name('updateUser');
    Route::get('/user/delete/{user}', [UserController::class, 'destroy'])->name('deleteUser');

    Route::get('/event', [EventController::class, 'index'])->name('eventList');
    Route::get('/event/create', [EventController::class, 'create'])->name('createEvent');
    Route::post('/event/create', [EventController::class, 'store'])->name('storeEvent');
    Route::get('/event/edit/{event}', [EventController::class, 'edit'])->name('editEvent');
    Route::post('/event/edit/{event}', [EventController::class, 'update'])->name('updateEvent');
    Route::get('/event/delete/{event}', [EventController::class, 'destroy'])->name('deleteEvent');

    Route::get('/registration', [RegistrationController::class, 'index'])->name('registrationList');
    Route::get('/registration/create/{eventId}', [RegistrationController::class, 'create'])->name('createRegistration');
    Route::post('/registration/create/{eventId}', [RegistrationController::class, 'store'])->name('storeRegistration');
    Route::get('/registration/edit/{registration}', [RegistrationController::class, 'edit'])->name('editRegistration');
    Route::post('/registration/edit/{registration}', [RegistrationController::class, 'update'])->name('updateRegistration');
    Route::get('/registration/payment/{eventId}', [RegistrationController::class, 'listParticipants'])->name('paymentList');
    Route::get('/registration/payment/edit/{registration}', [RegistrationController::class, 'payment'])->name('updatePayment');

    Route::get('/presence/create/{registration}', [PresenceController::class, 'create'])->name('createPresence');
    Route::post('/presence/create/{registration}', [PresenceController::class, 'store'])->name('storePresence');

    Route::get('/certificate/create/{registration}', [CertificateController::class, 'create'])->name('createCertificate');
    Route::post('/certificate/create/{registration}', [CertificateController::class, 'store'])->name('storeCertificate');
    Route::get('/certificate/edit/{certificate}', [CertificateController::class, 'edit'])->name('editCertificate');
    Route::post('/certificate/edit/{certificate}', [CertificateController::class, 'update'])->name('updateCertificate');
    Route::get('/scan/{qr_code?}', [PresenceController::class, 'scan'])->name('scanPresence');
});