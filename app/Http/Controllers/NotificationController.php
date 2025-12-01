<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update(['status' => 'read']);

        $link = '#';

        if ($notification->referenceType === 'comment') {
            $link = route('forum') . '#comment-' . $notification->referenceId;
        }else if($notification->referenceType === 'post'){
            $link = route('forum') . '#comment-' . $notification->referenceId;
        }else if($notification->referenceType === 'membership'){
            $link = route('membership');
        }else if($notification->referenceType === 'project'){
            $link = route('lecturer.nilai-projek');
        }

        return redirect()->away($link);
    }
}
