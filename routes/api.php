<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\QuestionController;
// use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/blogs', [BlogController::class, 'index']); // list all blogs
Route::get('/blogs/{blog}', [BlogController::class, 'show']); // single blog
Route::get('/blog-categories', [BlogCategoryController::class, 'index']);
// Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/faq-categories', [FaqCategoryController::class, 'index']);
// Route::get('/questions', [QuestionController::class, 'index']);
// Route::get('/services', [ServiceController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    
    // Blogs CRUD
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::put('/blogs/{blog}', [BlogController::class, 'update']);
    // Route::patch('/blogs/{id}', [BlogController::class, 'update']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);

    // Blog Categories CRUD
    Route::post('/blog-categories', [BlogCategoryController::class, 'store']);
    Route::put('/blog-categories/{blogCategory}', [BlogCategoryController::class, 'update']);
    Route::patch('/blog-categories/{blogCategory}', [BlogCategoryController::class, 'update']);
    Route::delete('/blog-categories/{blogCategory}', [BlogCategoryController::class, 'destroy']);

    // Comments CRUD
    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::patch('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // Likes
    Route::post('/likes', [LikeController::class, 'store']);
    Route::delete('/likes/{id}', [LikeController::class, 'destroy']);

    // FAQs
    Route::post('/faqs', [FaqController::class, 'store']);
    Route::put('/faqs/{id}', [FaqController::class, 'update']);
    Route::patch('/faqs/{id}', [FaqController::class, 'update']);
    Route::delete('/faqs/{id}', [FaqController::class, 'destroy']);

    // FAQ Categories
    Route::post('/faq-categories', [FaqCategoryController::class, 'store']);
    Route::put('/faq-categories/{id}', [FaqCategoryController::class, 'update']);
    Route::patch('/faq-categories/{id}', [FaqCategoryController::class, 'update']);
    Route::delete('/faq-categories/{id}', [FaqCategoryController::class, 'destroy']);

    // Questions
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::put('/questions/{id}', [QuestionController::class, 'update']);
    Route::patch('/questions/{id}', [QuestionController::class, 'update']);
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);

    });

require __DIR__.'/auth.php';

git config --global user.email "abhijan097.com"
  git config --global user.name "abhijanb"