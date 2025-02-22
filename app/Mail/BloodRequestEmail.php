<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BloodRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    var $email;
    var $attendent_name;
    var $attendent_mobile;
    var $patent_blood_group;
    var $unit_required;
    var $hospital_name;
    var $hospital_address;
    var $name;

    public function __construct($name, $email, $attendent_name,$attendent_mobile,$patent_blood_group,$unit_required,$hospital_name,$hospital_address)
    {
        $this->name = $name;
        $this->email = $email;
        $this->attendent_name = $attendent_name;
        $this->attendent_mobile = $attendent_mobile;
        $this->patent_blood_group = $patent_blood_group;
        $this->unit_required = $unit_required;
        $this->hospital_name = $hospital_name;
        $this->hospital_address = $hospital_address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('noreply@humanity.in')
            ->to($this->email)
            ->subject('Urgent Blood Required')
            ->markdown('mails.blood-request', ['name' => $this->name, 'attendent_name' => $this->attendent_name,'attendent_mobile' => $this->attendent_mobile,'patent_blood_group' => $this->patent_blood_group,'unit_required' => $this->unit_required,'hospital_name' => $this->hospital_name,'hospital_address' => $this->hospital_address]);
    }
}
