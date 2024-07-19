<?php

namespace App\Utilities;

class Session
{
    private static bool $isStarted = false;
    private static bool $isExpired = false;
    private static ?int $expirationDelay = 5;
    
    private static function configureSession() : void
    {
        // https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html#session-id-generation-and-verification-permissive-and-strict-session-management
        if (!ini_get('session.use_strict_mode')) {
            ini_set('session.use_strict_mode', '1');
        }
        // https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html#secure-attribute
        session_set_cookie_params([
            'lifetime' => 0,
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
        ]);
        //https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html#session-id-name-fingerprinting
        session_name('id');
    }

    public static function start() 
    {
        self::configureSession();
        session_start();
        if(!isset($_SESSION['expiration'])) $_SESSION['expiration'] = strtotime('now');
        
        self::$isStarted = (session_status() === PHP_SESSION_ACTIVE);
        self::$isExpired = ($_SESSION['expiration'] + self::$expirationDelay < strtotime('now'));

        if(self::$isExpired) {
            session_unset();
            self::regenerateId();
        }
    }

    public static function destroy() : void
    {
        session_unset();
        session_destroy();
    }

    // https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html#renew-the-session-id-after-any-privilege-level-change
    public static function regenerateId()
    {
        session_regenerate_id(true);
    }

    public static function getIsStarted() : bool
    {
        return self::$isStarted;
    }

    public static function getIsExpired() : bool
    {
        return self::$isExpired;
    }

    public static function resetExpirationDelay() : void
    {
        $_SESSION['expiration'] = self::$expirationDelay;

    }
}