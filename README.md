![NTP reader](.github/logo.png)

[![Build Status](https://travis-ci.org/filipsedivy/NTP.svg?branch=master)](https://travis-ci.org/filipsedivy/NTP)

Introduction
------------

The NTP reader is a class for reading data from the NTP server over the UDP / TCP port. The class allows:

- read data from the NTP server
- transfer output data to the [Carbon library](https://github.com/briannesbitt/Carbon) for processing time


Installation
------------

The recommended way to is via [Composer](https://packagist.org/packages/filipsedivy/ntp):

```
composer require filipsedivy/ntp
```

It requires PHP version 7.1 and supports PHP up to 7.2.

### Tests

To run the tests, you must run this command via Composer

```
composer test
```


Usage
-----

```php
$socket = FilipSedivy\NTP\Socket::create('europe.pool.ntp.org');
$datetime = FilipSedivy\NTP\Client::getDateTime($socket);

// Carbon library
echo $datetime->toDateTimeString();

// Alternatively DateTime functions
echo $datetime->format(...);
```