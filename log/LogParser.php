<?php

namespace Log;

use Log\Reader\Reader;

class LogParser
{
    public static function parse(Reader $reader, \DateTime $focusDate): Map
    {
        $map = new Map();
        while($reader->hasMoreLines()) {
            $line = $reader->nextLine();
            [$ts, $bytes, $status, $ip] = explode(';', $line);
            $singleValue = new SingleInputValue(
                ip: $ip,
                status: $status,
                timestamp: intval($ts),
                bytes: intval($bytes),
            );
            if (!$singleValue->isOk() || !$singleValue->isDateWithinRange($focusDate)) {
                continue;
            }
            $map->newRequest($singleValue);
        }
        return $map;
    }
}