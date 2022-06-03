<?php

date_default_timezone_set('Europe/Rome');

$file = new SplFileObject(__DIR__ . '/requests.log', 'w');
$ips = [
    '192.168.1.1',
    '192.168.1.2',
    '192.168.1.3',
    '192.168.1.4',
    '192.168.1.5',
    '192.168.1.6',
    '192.168.1.7',
    '192.168.1.8',
    '192.168.1.9',
];
for ($i = 0; $i < 1000; $i++) {
    $status = rand(0, 100) <= 90 ? 'OK' : 'KO';
    $ip = $ips[mt_rand(0, count($ips) - 1)];
    $ts = (new DateTime())->getTimestamp();
    $string = $ts.";".mt_rand(10, 300000).";".$status.';'.$ip;
    if ($i < 999) {
        $string .= PHP_EOL;
    }
    $file->fwrite($string);
}
$file = null;