<?php

class Cookie
{

    public static function set($key, $value, $time = "")
    {
        setcookie($key, serialize($value), $time);
    }

    public static function get($key)
    {
        if (isset($_COOKIE[$key]))
            return unserialize($_COOKIE[$key]);
        else
            return [];
    }

    public static function delete($key)
    {
        if (isset($_COOKIE[$key])) setcookie($key);
    }

}

