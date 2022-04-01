<?php

use App\Http\Controllers\Auth\RegisterGerejaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resource\FormController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::group(["prefix" => "resources"], function () {
    Route::get('/gereja-by-wilayah', [FormController::class, 'gerejaByWilayah'])->name('resource.gereja-by-wilayah');
});

Auth::routes([
    // 'register' => false, // Registration Routes...
]);

Route::get('/register/gembala/5526f5323af331ab22dac08d817cfb7520a80fc1', [RegisterGerejaController::class, "showRegistrationForm"])->name("register.gembala");
Route::post('/register/gembala/5526f5323af331ab22dac08d817cfb7520a80fc1', [RegisterGerejaController::class, "register"]);


Route::get('/', [ForumController::class, 'index'])->name('home');
Route::get('/forum/{slug}', [ForumController::class, 'show'])->name('forum.detail');
Route::get('/popular', [ForumController::class, 'show'])->name('forum.popular');

Route::get('/tag', [TagController::class, 'index'])->name('tag');
Route::get('/tag/{slug}', [TagController::class, 'show'])->name('tag.detail');


Route::group([
    "middleware" => ["auth"],
    "prefix" => "user"
], function () {

    Route::get('/my-account', [ProfileController::class, 'show'])->name('account');
    Route::get('/edit-account', [ProfileController::class, 'edit'])->name('account.edit');
    Route::post('/edit-account', [ProfileController::class, 'update'])->name('account.store');

    Route::group(["middleware" => "menuautho"], function () {
        Route::group(["prefix" => "/forum"], function () {
            Route::get('/create', [ForumController::class, 'create'])->name('forum.add');
            Route::get('/{forum}/edit', [ForumController::class, 'edit'])->name('forum.edit');

            Route::post('/create', [ForumController::class, 'store'])->name('forum.store');
            Route::put('/{forum}/edit', [ForumController::class, 'update'])->name('forum.update');
            Route::delete('/{forum}/delete', [ForumController::class, 'destroy'])->name('forum.delete');
        });

        Route::group(["prefix" => "/comment"], function () {
            Route::get('/{comment}', [CommentController::class, 'edit'])->name('comment.edit');

            Route::post('/{forum}/create', [CommentController::class, 'store'])->name('comment.store');
            Route::put('/{comment}', [CommentController::class, 'update'])->name('comment.update');
            Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('comment.delete');
        });

        Route::group(["prefix" => "/tag"], function () {
            Route::get('/create', [TagController::class, 'create'])->name('tag.add');
            Route::get('/{tag}', [TagController::class, 'edit'])->name('tag.edit');

            Route::post('/create', [TagController::class, 'store'])->name('tag.store');
            Route::put('/{tag}', [TagController::class, 'update'])->name('tag.update');
            Route::delete('/{tag}', [TagController::class, 'destroy'])->name('tag.delete');
        });
    });
});
