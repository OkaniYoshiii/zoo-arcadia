<?php

namespace App\Utilities;

class UserAlertsContainer
{
    private static array $alerts = [];

    public static function add(string $alert)
    {
        self::$alerts[] = $alert;
    }

    public static function hasAlerts() : bool
    {
        return (!empty(self::$alerts));
    }

    public static function getAlerts()
    {
        return self::$alerts;
    }
}