<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;
    public $pdfPath;
    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct($name, $email, $message, $pdfPath)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('sattreegurukul@gmail.com')
            ->to($this->email)
            ->subject('Notification From Sattree Gurukul')
            ->markdown('mails.teacher-notification', ['name' => $this->name, 'email' => $this->email, 'message' => $this->message])
            ->attach($this->pdfPath, [
                'as' => 'attachement.jpg',
            ]);
    }
}
