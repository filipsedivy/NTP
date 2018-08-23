<?php

require_once __DIR__ . '/../vendor/autoload.php';

use FilipSedivy\NTP;

$socket = NTP\Socket::create('europe.pool.ntp.org');
$datetime = NTP\Client::getDateTime($socket);

echo $datetime->toDateTimeString();