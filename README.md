# rabbitmq-management-api

RabbitMQ Management HTTP API

[![Packagist Version](https://img.shields.io/packagist/v/kain/rabbitmq-management-api.svg?style=flat-square)](https://packagist.org/packages/kain/rabbitmq-management-api)
[![Travis (.org)](https://img.shields.io/travis/kainonly/rabbitmq-management-api.svg?style=flat-square)](https://travis-ci.org/kainonly/rabbitmq-management-api)
[![Coveralls github](https://img.shields.io/coveralls/github/kainonly/rabbitmq-management-api.svg?style=flat-square)](https://coveralls.io/github/kainonly/rabbitmq-management-api)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/kain/rabbitmq-management-api.svg?color=blue&style=flat-square)](https://github.com/kainonly/rabbitmq-management-api)
[![Packagist](https://img.shields.io/packagist/dt/kain/rabbitmq-management-api.svg?color=blue&style=flat-square)](https://packagist.org/packages/kain/rabbitmq-management-api)
[![License](https://img.shields.io/packagist/l/kain/rabbitmq-management-api.svg?color=blue&style=flat-square)](https://github.com/kainonly/rabbitmq-management-api/blob/master/LICENSE)

#### Setup

```shell
composer require kain/rabbitmq-management-api
```

#### Usage
     
Create an RabbitMQ Management HTTP API client

```php
use RabbitMQ\API\RabbitMQ;
use GuzzleHttp\Client;

$api = RabbitMQ::create(
    'http://localhost:15672/api/',
    'guest',
    'guest'
);

// Can also be like this
$client = new Client([
    'base_uri' => 'https://myrabbitproxy.com/api/',
    'auth' => ['guest', 'guest'],
    'timeout' => 30.0,
    'debug' => true,
    'verify' => false,
    'version' => 2.0
]);
$this->api = new RabbitMQ($client);
```

Get overview

```php
use RabbitMQ\API\RabbitMQ;

$api = RabbitMQ::create(
    'http://localhost:15672/api/',
    'guest',
    'guest'
);

$response = $api->overview();

// Whether the response failed
$response->isError();

// Respond to the prompt message
$response->getMsg();

// Response return data
$response->getData();

// Returns an array of responses
$result = $response->result();
```

> Use method is consistent with the document [http://localhost:15672/api/index.html](http://localhost:15672/api/index.html)