<?php

namespace App\Services;

use GuzzleHttp\Client;

class AgoraService
{
    protected $client;
    protected $appId;
    protected $appCertificate;

    public function __construct()
    {
        $this->client = new Client();
        $this->appId = env('AGORA_APP_ID');
        $this->appCertificate = env('AGORA_APP_CERTIFICATE');
    }

    public function generateToken($channelName, $uid, $role, $expireTimeInSeconds)
    {
        $currentTimestamp = time();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        
        return \RtcTokenBuilder::buildTokenWithUid($this->appId, $this->appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
    }
}
