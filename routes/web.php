<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Tag\TagController;
use App\Http\Controllers\Video\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Photo\PhotoController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/bio', function () {
    return Inertia::render('Bio', [
        'bio' => Auth::user(),
    ]);
})->middleware(['auth', 'verified'])->name('me');

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/posts', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('posts');
Route::get('/articles', [ArticleController::class, 'index'])->middleware(['auth', 'verified'])->name('articles');
Route::get('/tags', [TagController::class, 'index'])->middleware(['auth', 'verified'])->name('tags');
Route::get('/videos', [VideoController::class, 'index'])->middleware(['auth', 'verified'])->name('videos');
Route::get('/photos', [PhotoController::class, 'index'])->middleware(['auth', 'verified'])->name('photos');
Route::get('/comments', [CommentController::class, 'index'])->middleware(['auth', 'verified'])->name('comments');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
