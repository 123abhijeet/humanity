<?php

// Get the last enrollment ID from the database

namespace App\Helpers;

use App\Models\Backend\Coursecertificate;
use Carbon\Carbon;

class certificate_no_helper
{
    public static function nextCertificateNo()
    {
        // Get the current timestamp part
        $currentTimestamp = Carbon::now()->format('YmdHis');

        // Get the last certificate number from the database
        $lastCertificateNo = Coursecertificate::max('certificate_no');

        if (!$lastCertificateNo) {
            // If there's no last certificate, start with SAT + current timestamp + 1
            return 'SAT' . $currentTimestamp . '1';
        }

        // Extract the timestamp and the numeric part of the last certificate number
        $lastTimestamp = substr($lastCertificateNo, 3, 14);
        $lastNumericPart = intval(substr($lastCertificateNo, 17));

        if ($lastTimestamp === $currentTimestamp) {
            // If the last timestamp matches the current timestamp, increment the numeric part
            $nextNumericPart = $lastNumericPart + 1;
        } else {
            // If the last timestamp does not match the current timestamp, start with 1
            $nextNumericPart = 1;
        }

        // Generate the next certificate number
        $nextCertificateNo = 'SAT' . $currentTimestamp . $nextNumericPart;

        return $nextCertificateNo;
    }
}
