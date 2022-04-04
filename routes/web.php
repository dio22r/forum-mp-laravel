<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MenuManagementController;
use App\Http\Controllers\Admin\RoleManagementController;
use App\Http\Controllers\Admin\UserManagementController;
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

    Route::group(["middleware" => "mustverified"], function () {
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


Route::group([
    "middleware" => ["auth", "adminonly"],
    "prefix" => "admin"
], function () {
    Route::get('/', function () {
        return redirect()->route('admin.home');
    });

    Route::group(["middleware" => ["menuautho"]], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');

        Route::group(["prefix" => "/user-management"], function () {
            Route::get("/", [UserManagementController::class, 'index'])->name('user-management.index');
            Route::get("/create", [UserManagementController::class, 'create'])->name('user-management.create');
            Route::get("/{user}", [UserManagementController::class, 'show'])->name('user-management.detail');
            Route::get("/{user}/edit", [UserManagementController::class, 'edit'])->name('user-management.edit');

            Route::post("/", [UserManagementController::class, 'store'])->name('user-management.store');
            Route::put("/{user}", [UserManagementController::class, 'update'])->name('user-management.update');
            Route::delete("/{user}", [UserManagementController::class, 'destroy'])->name('user-management.destroy');
        });

        Route::group(["prefix" => "/role-management"], function () {
            Route::get("/", [RoleManagementController::class, 'index'])->name('role-management.index');
            Route::get("/create", [RoleManagementController::class, 'create'])->name('role-management.create');
            Route::get("/{role}", [RoleManagementController::class, 'show'])->name('role-management.detail');
            Route::get("/{role}/edit", [RoleManagementController::class, 'edit'])->name('role-management.edit');
            Route::get("/{role}/permision", [RoleManagementController::class, 'editPermission'])->name('role-management.permission');

            Route::post("/", [RoleManagementController::class, 'store'])->name('role-management.store');
            Route::put("/{role}", [RoleManagementController::class, 'update'])->name('role-management.update');
            Route::post("/{role}/permision", [RoleManagementController::class, 'updatePermission'])->name('role-management.uppdate-permission');
            Route::delete("/{role}", [RoleManagementController::class, 'destroy'])->name('role-management.destroy');
        });

        Route::group(["prefix" => "/menu-management"], function () {
            Route::get("/", [MenuManagementController::class, 'index'])->name('menu-management.index');
            Route::get("/create", [MenuManagementController::class, 'create'])->name('menu-management.create');
            Route::get("/{menu}", [MenuManagementController::class, 'show'])->name('menu-management.detail');
            Route::get("/{menu}/edit", [MenuManagementController::class, 'edit'])->name('menu-management.edit');

            Route::post("/", [MenuManagementController::class, 'store'])->name('menu-management.store');
            Route::put("/{menu}", [MenuManagementController::class, 'update'])->name('menu-management.update');
            Route::delete("/{menu}", [MenuManagementController::class, 'destroy'])->name('menu-management.destroy');
        });
    });
});
