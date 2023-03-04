<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/posts/slug',[PostController::class,'generateSlug'])->name('api.post.slug');
