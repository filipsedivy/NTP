<?php
/**
 * Test: NTP.
 *
 * @testCase
 */

use Tester\Assert;
use Tester\TestCase;
use FilipSedivy\NTP\Socket;
use FilipSedivy\NTP;

require_once __DIR__ . '/../bootstrap.php';

class NTPTest extends TestCase
{
    public function testCarbon()
    {
        $socket = Socket::create('europe.pool.ntp.org', 123, 5);
        $datetime = NTP::getDateTime($socket);

        Assert::same(get_class($datetime), 'Carbon\Carbon');
        Assert::type('string', $datetime->toDateTimeString());
        Assert::type('int', $datetime->getTimestamp());
        Assert::type('string', NTP::getTimestamp($socket));
    }
}

(new NTPTest())->run();