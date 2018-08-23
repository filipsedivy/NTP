<?php
/**
 * Test: Socket.
 *
 * @testCase
 */

use Tester\Assert;
use Tester\TestCase;
use FilipSedivy\NTP;

require_once __DIR__ . '/../bootstrap.php';

class SocketTest extends TestCase
{
    public function testObject()
    {
        $socket = NTP\Socket::create('europe.pool.ntp.org');

        Assert::type('object', $socket);
        Assert::same(get_class($socket), 'FilipSedivy\NTP\Socket');
    }


    public function testProperties()
    {
        $socket = NTP\Socket::create('europe.pool.ntp.org', 123);

        Assert::type('string', $socket->getHost());
        Assert::type('int', $socket->getPort());
        Assert::type('int', $socket->getTimeout());
        Assert::type('string', $socket->getAddress());
        Assert::contains('udp://', $socket->getAddress());
        Assert::same('udp://europe.pool.ntp.org:123', $socket->getAddress());
        Assert::type('object', $socket->getClient());
        Assert::same(get_class($socket->getClient()), 'Socket\Raw\Socket');
    }
}

(new SocketTest())->run();