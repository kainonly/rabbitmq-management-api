<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use RabbitMQ\API\RabbitMQ;

abstract class BaseTest extends TestCase
{
    protected string $cluster;
    protected string $node;
    protected string $amqp;
    protected string $user;
    protected string $pass;
    protected RabbitMQ $api;

    public function setUp(): void
    {
        $this->cluster = getenv('cluster');
        $this->node = getenv('node');
        $this->amqp = getenv('amqp');
        $this->user = getenv('user');
        $this->pass = getenv('pass');
        $client = new Client([
            'base_uri' => getenv('uri'),
            'auth' => [$this->user, $this->pass],
            'timeout' => 30.0,
            'debug' => false,
            'verify' => false,
            'version' => getenv('version') ? (float)getenv('version') : 1.1
        ]);
        $this->api = new RabbitMQ($client);
    }
}