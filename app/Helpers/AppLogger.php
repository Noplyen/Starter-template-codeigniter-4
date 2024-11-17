<?php

namespace App\Helpers;

use App\ThirdParty\MonologConfig;

class AppLogger
{
    public static function getMonologConfig()
    {
        $logger = new MonologConfig();

        return $logger->config();
    }
}