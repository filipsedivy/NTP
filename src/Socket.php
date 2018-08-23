<?php

namespace FilipSedivy\NTP;

use Socket\Raw\Factory;

class Socket
{
    /** @var string */
    private $host;

    /** @var int */
    private $port;

    /** @var int */
    private $timeout;

    /********************* static access ******************/

    /**
     * @param string $host
     * @param int    $port
     * @param int    $timeout
     *
     * @return self
     */
    public static function create(string $host, int $port = null, int $timeout = null): self
    {
        $instance = new self();
        $instance->setHost($host);

        if (null !== $port)
        {
            $instance->setPort($port);
        }

        if (null !== $timeout)
        {
            $instance->setTimeout($timeout);
        }

        return $instance;
    }

    /********************* instance access ******************/


    public function __construct()
    {
        $this->setPort(123);
        $this->setTimeout(10);
    }


    /**
     * @param string $host
     *
     * @return void
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }


    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }


    /**
     * @param int $port
     *
     * @return void
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }


    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }


    /**
     * @param int $timeout
     *
     * @return void
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }


    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }


    /********************* methods ******************/


    /**
     * @param string $protocol
     *
     * @return string
     */
    public function getAddress(string $protocol = 'udp'): string
    {
        return sprintf('%s://%s:%s', $protocol, $this->getHost(), $this->getPort());
    }

    /**
     * @return \Socket\Raw\Socket
     */
    public function getClient(): \Socket\Raw\Socket
    {
        $factory = new Factory();
        return $factory->createClient($this->getAddress());
    }
}