<?php

namespace App\Http\View\Composers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TutorNotificationComposer
{
    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
        
    // }

    public function compose(View $view)
    {
        $user = Auth::user();

        if($user && $user->role === 'lecturer'){
            $notifications = Notification::where('userId', $user->id)
                ->orderBy('notificationDate', 'desc')
                ->get();
            $unreadCount = Notification::where('status', 'unread')
                ->where('userId', $user->id)
                ->count();
        }else{
            $notifications = collect();
            $unreadCount = 0;
        }

        $view->with([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
}
