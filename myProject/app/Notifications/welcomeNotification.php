<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class welcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationData)
    {
        $this->data=$notificationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
         
        $mailMessage = new MailMessage;
        foreach ($this->data['myfiles'] as $file) {
            $attachmentPath = storage_path('app/public/' . $file);
            $mailMessage->attach($attachmentPath);
        }

        
        
        return $mailMessage
        ->greeting($this->data['title'])
                    ->line($this->data['url'])
                    ->action('Click Here', url('/'))
                    ->line($this->data['body']);



                    // ->greeting($this->data['name'])
                    // ->line($this->data['url'])
                    // ->action('Click here', url('/'))
                    // ->line($this->data['body']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }               
}

// foreach ($files as $file) {
    //     // Store the file in the public directory
    //     $file->storeAs('public', $file->getClientOriginalName());
    // }

// $file=$request->file('myfiles');
// $originalNames=$file->getClientOriginalName();

// Store the file in the public directory
// $file->storeAs('public', $originalName);
// $file->move('images/', $originalNames);