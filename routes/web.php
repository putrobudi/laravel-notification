<?php

use App\Http\Controllers\ConversationBestReplyController;
use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UserNotificationsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::get('payments/create', [PaymentsController::class, 'create'])->middleware('auth');
Route::post('payments', [PaymentsController::class, 'store'])->middleware('auth');
Route::get('notifications', [UserNotificationsController::class, 'show'])->middleware('auth');

Route::get('conversations', [ConversationsController::class, 'index']);
Route::get('conversations/{conversation}', [ConversationsController::class, 'show']);

Route::post('best-replies/{reply}', [ConversationBestReplyController::class, 'store']);