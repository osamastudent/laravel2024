<?php

namespace App\Http\Controllers;

use App\Mail\Orders;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error\Notice;
use Illuminate\Support\Facades\Mail;
use App\Notifications\welcomeNotification;
use Illuminate\Support\Facades\Notification;

class maleController extends Controller
{


    
    // email send
    function sendEmail()
    {
        return view('users.send-email');
    }

    function sendEmailToUser(Request $request)
    {
        Mail::to($request->email)->send(new Orders($request));
        return back()->with("status", "email sent successfully");
    }

    // view email data
    function sendDataView()
    {
        return view('users.send-data-view');
    }
    /////////////////////////////////////////

    //send Notification
    function sendNotification()
    {
        return view('users.send-notification');
    }
    function sendNotificationToUser(Request $request)
    {
        $users = User::all();

        $files = $request->file('myfiles');
        $originalNames = [];

        foreach ($files as $file) {
            $originalNames[] = $file->getClientOriginalName();
            $file->storeAs('public', $file->getClientOriginalName());
        }


        $notificationData = [
            'subject' => $request->subject,
            'title' => $request->title,
            'body' => $request->body,
            'url' => $request->url,
            'myfiles' => $originalNames,

        ];
        foreach ($users as $user) {

            Notification::send($users, new welcomeNotification($notificationData));
        }
        return back()->with("status", "Notification sent successfully");
    }




    function postStoreMale(Request $request)
    {
        $data = $request->only(['post_category_id', 'post_name', 'post_desc']);
        $user = auth()->user();
        $data['user_id'] = $user->id;

        
        $file = $request->file('post_image');
        if ($file) {
                $originalName = $file->getClientOriginalName();
                $file->storeAs('styllyImages', $originalName, 'public');
                $imageNameOnly = basename($originalName);
                $data['post_image']=$imageNameOnly;
            }
        
        

        post::create($data);
        return back()->with('status', "succcesss");
    }

}
