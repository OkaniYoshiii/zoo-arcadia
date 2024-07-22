<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(__CLASS__ . '::autoload');
    }

    public static function autoload(string $className)
    {
        // Garde uniquement le nom de la classe lorsque cette dernière contient un namespace
        if(self::isNamespaced($className)) {
            $last_backslash_pos = strrpos($className, '\\');
            $className = substr($className, $last_backslash_pos);
        }; 

        $className = str_replace('\\','', $className);

        foreach(SRC_FOLDERS as $folder)
        {
            $filepath = $folder .  '/' . $className . '.php';
            if(file_exists($filepath)) require $filepath;
        }
    }

    public static function isNamespaced($className)
    {
        return str_contains($className, '\\');
    }
}