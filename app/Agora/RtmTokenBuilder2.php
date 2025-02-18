<?php

namespace App\Agora;

use App\Agora\AccessToken2;

class RtmTokenBuilder2
{
    /**
     * Build the RTM token.
     *
     * @param $appId :          The App ID issued to you by Agora. Apply for a new App ID from
     *                          Agora Dashboard if it is missing from your kit. See Get an App ID.
     * @param $appCertificate : Certificate of the application that you registered in
     *                          the Agora Dashboard. See Get an App Certificate.
     * @param $userId :         The user's account, max length is 64 Bytes.
     * @param $expire :         represented by the number of seconds elapsed since now. If, for example, you want to access the
     *                          Agora Service within 10 minutes after the token is generated, set expireTimestamp as 600(seconds).
     * @return The RTM token.
     */
    public static function buildToken($appId, $appCertificate, $userId, $expire)
    {
        $accessToken = new AccessToken2($appId, $appCertificate, $expire);
        $serviceRtm = new ServiceRtm($userId);

        $serviceRtm->addPrivilege($serviceRtm::PRIVILEGE_LOGIN, $expire);
        $accessToken->addService($serviceRtm);

        return $accessToken->build();
    }
}
