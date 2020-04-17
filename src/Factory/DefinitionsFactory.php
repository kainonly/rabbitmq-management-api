<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class DefinitionsFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * DefinitionsFactory constructor.
     * @param HttpClientInterface $client
     * @param string $vhost
     */
    public function __construct(
        HttpClientInterface $client,
        string $vhost
    )
    {
        parent::__construct($client);
        $this->vhost = urlencode($vhost);
    }

    /**
     * @return Response
     */
    public function get(): Response
    {
        return $this->client->request(
            'GET',
            ['definitions', $this->vhost]
        );
    }

    /**
     * @param array $data
     * @return Response
     */
    public function post(array $data): Response
    {
        return $this->client->request(
            'POST',
            ['definitions', $this->vhost],
            null,
            $data
        );
    }
}