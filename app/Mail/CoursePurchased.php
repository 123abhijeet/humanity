<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CoursePurchased extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($studentName, $email, $course_name, $pdfPath)
    {
        $this->studentName = $studentName;
        $this->email = $email;
        $this->pdfPath = $pdfPath;
        $this->course_name = $course_name;
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
            ->subject('Course Purchase Receipt')
            ->markdown('mails.course-purchased', ['studentName' => $this->studentName,'course_name' => $this->course_name])
            ->attach($this->pdfPath, [
                'as' => 'payment_receipt.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
