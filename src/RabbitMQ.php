<?php
declare(strict_types=1);

namespace RabbitMQ\API;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;
use RabbitMQ\API\Common\HttpClient;
use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;
use RabbitMQ\API\Factory\BindingsFactory;
use RabbitMQ\API\Factory\ChannelsFactory;
use RabbitMQ\API\Factory\ConnectionsFactory;
use RabbitMQ\API\Factory\ConsumersFactory;
use RabbitMQ\API\Factory\DefinitionsFactory;
use RabbitMQ\API\Factory\ExchangesFactory;
use RabbitMQ\API\Factory\GlobalParametersFactory;
use RabbitMQ\API\Factory\NodesFactory;
use RabbitMQ\API\Factory\OperatorPoliciesFactory;
use RabbitMQ\API\Factory\ParametersFactory;
use RabbitMQ\API\Factory\PermissionsFactory;
use RabbitMQ\API\Factory\PoliciesFactory;
use RabbitMQ\API\Factory\QueuesFactory;
use RabbitMQ\API\Factory\TopicPermissionsFactory;
use RabbitMQ\API\Factory\UsersFactory;
use RabbitMQ\API\Factory\VhostLimitsFactory;
use RabbitMQ\API\Factory\VhostsFactory;

class RabbitMQ
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $client;

    /**
     * @param string $uri
     * @param string $user
     * @param string $pass
     * @param float $timeout
     * @return static
     */
    public static function create(
        string $uri,
        string $user,
        string $pass,
        float $timeout = 5.0
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
     */
    public function __construct(Client $client)
    {
        $this->container = new Container();
        $this->client = new HttpClient($client);
        $this->container->set(HttpClientInterface::class, $this->client);
    }

    /**
     * @return Response
     */
    public function getOverview(): Response
    {
        return $this->client->request(
            'GET',
            ['overview']
        );
    }

    /**
     * @return Response
     */
    public function getClusterName(): Response
    {
        return $this->client->request(
            'GET',
            ['cluster-name']
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function putClusterName(string $name): Response
    {
        return $this->client->request(
            'PUT',
            ['cluster-name'],
            null,
            [
                'name' => $name
            ]
        );
    }

    /**
     * @return NodesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function nodes(): NodesFactory
    {
        return $this->container->make(NodesFactory::class);
    }

    /**
     * @return Response
     */
    public function getExtensions(): Response
    {
        return $this->client->request(
            'GET',
            ['extensions']
        );
    }

    /**
     * @param string $vhost
     * @return DefinitionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function definitions(string $vhost = ''): DefinitionsFactory
    {
        return $this->container->make(DefinitionsFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @param string $vhost
     * @return ConnectionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function connections(string $vhost = ''): ConnectionsFactory
    {
        return $this->container->make(ConnectionsFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @param string $vhost
     * @return ChannelsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function channels(string $vhost = ''): ChannelsFactory
    {
        return $this->container->make(ChannelsFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @param string $vhost
     * @return ConsumersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function consumers(string $vhost = ''): ConsumersFactory
    {
        return $this->container->make(ConsumersFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @param string $vhost
     * @return ExchangesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function exchanges(string $vhost = ''): ExchangesFactory
    {
        return $this->container->make(ExchangesFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @param string $vhost
     * @return QueuesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function queues(string $vhost = ''): QueuesFactory
    {
        return $this->container->make(QueuesFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @param string $vhost
     * @return BindingsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function bindings(string $vhost = ''): BindingsFactory
    {
        return $this->container->make(BindingsFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @return VhostsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function vhosts(): VhostsFactory
    {
        return $this->container->make(VhostsFactory::class);
    }

    /**
     * @return UsersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function users(): UsersFactory
    {
        return $this->container->make(UsersFactory::class);
    }

    /**
     * @return Response
     */
    public function getWhoami(): Response
    {
        return $this->client->request(
            'GET',
            ['whoami']
        );
    }

    /**
     * @return PermissionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function permissions(): PermissionsFactory
    {
        return $this->container->make(PermissionsFactory::class);
    }

    /**
     * @return TopicPermissionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function topicPermissions(): TopicPermissionsFactory
    {
        return $this->container->make(TopicPermissionsFactory::class);
    }

    /**
     * @param string $vhost
     * @return ParametersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function parameters(string $vhost = ''): ParametersFactory
    {
        return $this->container->make(ParametersFactory::class, [
            'vhost' => $vhost
        ]);
    }

    /**
     * @return GlobalParametersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function globalParameters(): GlobalParametersFactory
    {
        return $this->container->make(GlobalParametersFactory::class);
    }

    /**
     * @return PoliciesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function policies(): PoliciesFactory
    {
        return $this->container->make(PoliciesFactory::class);
    }

    /**
     * @return OperatorPoliciesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function operatorPolicies(): OperatorPoliciesFactory
    {
        return $this->container->make(OperatorPoliciesFactory::class);
    }

    /**
     * @param string $vhost
     * @return Response
     */
    public function alivenessTest(string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['aliveness-test', urlencode($vhost)]
        );
    }

    /**
     * @param string $node
     * @return Response
     */
    public function healthchecks(string $node = ''): Response
    {
        return $this->client->request(
            'GET',
            ['healthchecks', 'node', $node]
        );
    }

    /**
     * @return VhostLimitsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function vhostLimits(): VhostLimitsFactory
    {
        return $this->container->make(VhostLimitsFactory::class);
    }

    /**
     * @return Response
     */
    public function auth(): Response
    {
        return $this->client->request(
            'GET',
            ['auth']
        );
    }

    /**
     * @return Response
     */
    public function rebalanceQueues(): Response
    {
        return $this->client->request(
            'POST',
            ['rebalance', 'queues']
        );
    }
}