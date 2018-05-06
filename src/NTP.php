<?php

namespace FilipSedivy;

use Carbon\Carbon;
use FilipSedivy\NTP\Socket;
use DateTimeZone;
use Moontoast\Math\BigNumber;
use Stringy\Stringy;

class NTP
{

    /**
     * @param Socket       $socket
     * @param DateTimeZone $dateTimeZone
     *
     * @return Carbon
     *
     * @throws \InvalidArgumentException
     * @throws \Socket\Raw\Exception
     */
    public static function getDateTime(Socket $socket, DateTimeZone $dateTimeZone = null)
    {
        $timestamp = self::getTimestamp($socket);
        return Carbon::createFromTimestamp($timestamp, $dateTimeZone);
    }

    /**
     * @return int
     *
     * @throws \Socket\Raw\Exception
     * @throws \InvalidArgumentException
     */
    public static function getTimestamp(Socket $socket)
    {
        $client = $socket->getClient();

        $message = \call_user_func(function () {
            $start = Stringy::create("\010");
            $multiplier = Stringy::create("\0")->repeat(47);
            return $start->append($multiplier);
        });

        $client->write($message);
        $result = $client->read(48);

        $timestamp = \call_user_func(function ($result) {
            $unpack = unpack('N12', $result);
            $fetch = sprintf('%u', $unpack[9]);
            $bigNumber = new BigNumber($fetch);
            $bigNumber->subtract(2208988800);
            return $bigNumber->getValue();
        }, $result);

        return $timestamp;
    }
}