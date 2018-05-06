<?php

require_once __DIR__ . '/../vendor/autoload.php';

use FilipSedivy\NTP;
use FilipSedivy\NTP\Socket;

$socket = Socket::create('europe.pool.ntp.org');
$datetime = NTP::getDateTime($socket);

echo $datetime->toDateTimeString();