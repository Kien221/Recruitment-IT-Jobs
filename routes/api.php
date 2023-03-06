<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplyCvController;


Route::get('/posts/slug',[PostController::class,'generateSlug'])->name('api.post.slug');
Route::get('/ajax-paginate-posts',[HomeController::class,'ajax_paginate_posts'])->name('ajax.paginate');
Route::get('/ajax-paginate-hot-jobs',[HomeController::class,'ajax_paginate_hot_jobs'])->name('ajax.paginate.hot.jobs');
Route::put('/accept/applicant/cv',[ApplyCvController::class, 'acceptCv'])->name('accept.applicant.cv');
Route::put('/refuse/applicant/cv',[ApplyCvController::class, 'refuseCv'])->name('refuse.applicant.cv');
