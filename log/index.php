<?php

date_default_timezone_set('Europe/Rome');

require __DIR__ . '/../vendor/autoload.php';

$map = \Log\LogParser::parse(
    new \Log\Reader\FileReader(__DIR__ . '/requests.log'),
    new DateTime('2022-06-04')
);

$filePrinter = new \Log\Printer\FilePrinter(__DIR__ . '/ipaddr.csv');
$filePrinter->print($map);