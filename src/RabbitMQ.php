<?php
declare(strict_types=1);

namespace RabbitMQ\API;

use DI\Container;
use Exception;
use GuzzleHttp\Client;
use RabbitMQ\API\Common\HttpClient;
use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Factory\SystemFactory;

class RabbitMQ
{
    /**
     * @var Container
     */
    private Container $container;

    /**
     * @param string $uri
     * @param string $user
     * @param string $pass
     * @param float $timeout
     * @return static
     * @throws Exception
     */
    public static function create(
        string $uri,
        string $user,
        string $pass,
        float $timeout = 2.0
    ): self
    {
        $client = new Client([
            'base_uri' => $uri,
            'auth' => [$user, $pass],
            'timeout' => $timeout
        ]);
        return new self($client);
    }

    /**
     * RabbitMQ constructor.
     * @param Client $client
     * @throws Exception
     */
    public function __construct(Client $client)
    {
        $this->container = new Container();
        $httpClient = new HttpClient($client);
        $this->container->set(HttpClientInterface::class, $httpClient);
        $this->container->make(SystemFactory::class);
    }

    /**
     * @return SystemFactory
     * @throws Exception
     */
    public function system(): SystemFactory
    {
        return $this->container->get(SystemFactory::class);
    }
}