<?php

namespace FilipSedivy\NTP;

use Socket\Raw\Factory;

class Socket
{
    private $host;

    private $port;

    private $timeout;

    /********************* static access ******************/


    public static function create($host, $port = null, $timeout = null)
    {
        $instance = new self();
        $instance->setHost($host);

        if(null !== $port)
        {
            $instance->setPort($port);
        }

        if(null !== $timeout)
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

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }


    /********************* methods ******************/


    public function getAddress($protocol = 'udp')
    {
        return sprintf('%s://%s:%s', $protocol, $this->getHost(), $this->getPort());
    }

    public function getClient()
    {
        $factory = new Factory();
        return $factory->createClient($this->getAddress());
    }
}