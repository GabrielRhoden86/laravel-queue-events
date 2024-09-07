<?php

namespace App\Http\Controllers;
use App\Events\SendEventMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Queue;

class ControllerEvent extends Controller
{
    public function triggerEvent(User $user): string
    {
        User::chunk(5, function ($users) {
            foreach ($users as $user) {
                event(new SendEventMail($user));
            }
        });
        //$allUsers = $user::pluck("name")->toArray();
        return response()->json(['status' => 'Event triggered!']);
    }
}
