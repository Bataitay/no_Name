<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\sendNotification;
use Illuminate\Http\Request;
use Pusher\Pusher;

class NotificationController extends Controller
{
    public function create()
    {
        return view('Backend.Notification.createNotifi');
    }

    public function store(Request $request)
    {
        if (auth()->user()) {
            $users = User::all();
            $data = $request->only([
                'title',
                'content',
            ]);
            foreach ($users as $user) {
            $user->notify(new sendNotification($data));
            }
        }

        return redirect()->back();

    }
    public function readed($id){
        if($id){
            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return back();
    }

}
