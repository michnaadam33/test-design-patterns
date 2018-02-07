<?php

namespace App;

/**
 * Class Logger
 * @package App
 */
class Logger
{
    const LOG_DIR = __DIR__.'/../../logs/';

    /**
     * @param string $text
     * @param string $env
     */
    public static function error(string $text, string $env){
        self::log('ERROR: '. $text, $env);
    }

    /**
     * @param string $text
     * @param string $env
     */
    public static function log(string $text, string $env){
        $logText = $text . self::getTime();
        $logFile = self::LOG_DIR . $env . '.log';
        file_put_contents($logFile, $logText, FILE_APPEND | LOCK_EX);
    }

    /**
     * @return string
     */
    private static function getTime(){
        return (new \DateTime())->format(DATE_ATOM);
    }

}