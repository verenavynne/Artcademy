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
            $comment = \App\Models\Comment::find($notification->referenceId);
            $commentProfile = $comment->post->userId;

            if ($comment) {
                $link =  route('forum.visit-profile', [$commentProfile, 'tab' => 'post']) . '#comment-' . $notification->referenceId;
            } else {
                return redirect()->route('forum')
                    ->with('warning', 'Komentar yang dimaksud sudah dihapus.');
            }
            
        }else if($notification->referenceType === 'post'){
            $comment = \App\Models\Comment::find($notification->referenceId);

            if ($comment) {
                $link = route('my-profile', ['tab'=>'post']) . '#comment-' . $notification->referenceId;
            } else {
                return redirect()->route('forum')
                    ->with('warning', 'Komentar yang dimaksud sudah dihapus.');
            }
    
        }else if($notification->referenceType === 'membership'){
            $link = route('membership');
        }else if($notification->referenceType === 'grading'){
            $link = route('lecturer.nilai-projek');
        }else if($notification->referenceType === 'project'){
            $course = \App\Models\Course::find($notification->referenceId);
            $link = route('course.project',$course->id);
        }

        return redirect()->away($link);
    }
}
