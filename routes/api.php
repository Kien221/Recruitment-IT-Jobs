<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplyCvController;
use App\Http\Controllers\chattingController;


Route::get('/posts/slug',[PostController::class,'generateSlug'])->name('api.post.slug');
Route::get('/ajax-paginate-posts',[HomeController::class,'ajax_paginate_posts'])->name('ajax.paginate');
Route::get('/ajax-paginate-hot-jobs',[HomeController::class,'ajax_paginate_hot_jobs'])->name('ajax.paginate.hot.jobs');
Route::put('/accept/applicant/cv',[ApplyCvController::class, 'acceptCv'])->name('accept.applicant.cv');
Route::put('/refuse/applicant/cv',[ApplyCvController::class, 'refuseCv'])->name('refuse.applicant.cv');

//Job_by_city
Route::get('ajax-paginate-posts_by_city',[HomeController::class,'ajax_paginate_posts_by_city'])->name('ajax.paginate.posts_by_city');
Route::get('ajax-get_all_jobs',[HomeController::class,'ajax_get_all_jobs'])->name('ajax.get.all.jobs');
Route::get('count/messages',[ApplyCvController::class,'count_messages'])->name('count.messages');
Route::post('update/status/chatting',[chattingController::class,'updateStatusTextMessage'])->name('user.seen.message');
Route::get('count/chatting/message/not/seen',[chattingController::class,'count_chatting_message_not_seen'])->name('count.chatting.messages.not.seen');
Route::get('list/roomchat',[chattingController::class,'list_roomchat'])->name('list.roomchat');