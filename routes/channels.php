<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\applicant;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('Recruitment-channel.{id_applicant}', function($user, $id_applicant) {
    $applicant = applicant::find($applicant_id);
    if($applicant->id == $user->id){
        return true;
    }
    return false;
});
