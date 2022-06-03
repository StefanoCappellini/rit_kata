<?php

namespace Log\Printer;

use Log\Map;
use Log\SingleOutputValue;

class FilePrinter implements MapPrinter
{
    private \SplFileObject $file;

    public function __construct(string $path)
    {
        $this->file = new \SplFileObject($path, 'w');
    }

    public function print(Map $map)
    {
        $first = true;

        foreach ($map as $singleItem) {
            $line = '';
            if ($first) {
                $first = !$first;
            } else {
                $line .= PHP_EOL;
            }
            $line .= $singleItem->getIp() . ';';
            $line .= $singleItem->getNumberOfRequests() . ';';
            $line .= $singleItem->getPercentageOfTotalRequests($map->getTotalRequests()) . ';';
            $line .= $singleItem->getNumberOfBytes() . ';';
            $line .= $singleItem->getPercentageOfTotalBytes($map->getTotalBytes());

            $this->file->fwrite($line);
        }
    }
}