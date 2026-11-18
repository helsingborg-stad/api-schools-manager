<?php

namespace SchoolsManager\Helper;

class ExitCaller
{
    /**
     * Exit the script
     * Wrapper for exit() to allow for testing.
     */
    public static function exit()
    {
        exit;
    }
}
