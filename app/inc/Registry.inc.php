<?php

// this class makes it easy to send status from models and controllers to a view
// example: if INSERT-statement { status = success } else { stauts =  fail}
class Registry 
{
    private static $status = [];

    // set status
    public static function setStatus($status)
    {
        self::$status = $status;
    }

    // get the status with the inserted index
    // default null to prevent undefined index
    public static function getStatus($index = null)
    {
        // if the entered index is in $status array
        // return that status
        if (isset(self::$status[$index])) {
            return self::$status[$index];            
        } else {
            return self::$status;
        }
    }

    public static function getAllStatus()
    {
        return self::$status;
    }
}