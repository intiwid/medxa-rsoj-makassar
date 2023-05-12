<?php

function logging($message, $file)
{
    // setting the logging file in php.ini
    ini_set('error_log', $file);

    // logging error message to given log file
    error_log($message, 3, $file);
}
