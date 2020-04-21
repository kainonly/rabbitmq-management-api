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
use RabbitMQ\API\Factory\ClusterNameFactory;
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
     * Create RabbitMQ Api Client
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
     * Various random bits of information that describe the whole system.
     * @return Response
     */
    public function overview(): Response
    {
        return $this->client->request(
            'GET',
            ['overview']
        );
    }

    /**
     * name identifying
     * @return ClusterNameFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function clusterName(): ClusterNameFactory
    {
        return $this->container->make(ClusterNameFactory::class);
    }

    /**
     * RabbitMQ cluster nodes.
     * @return NodesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function nodes(): NodesFactory
    {
        return $this->container->make(NodesFactory::class);
    }

    /**
     * A list of extensions to the management plugin.
     * @return Response
     */
    public function extensions(): Response
    {
        return $this->client->request(
            'GET',
            ['extensions']
        );
    }

    /**
     * The server definitions
     * @return DefinitionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function definitions(): DefinitionsFactory
    {
        return $this->container->make(DefinitionsFactory::class);
    }

    /**
     * connections
     * @return ConnectionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function connections(): ConnectionsFactory
    {
        return $this->container->make(ConnectionsFactory::class);
    }

    /**
     * channels
     * @return ChannelsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function channels(): ChannelsFactory
    {
        return $this->container->make(ChannelsFactory::class);
    }

    /**
     * consumers
     * @return ConsumersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function consumers(): ConsumersFactory
    {
        return $this->container->make(ConsumersFactory::class);
    }

    /**
     * exchanges
     * @return ExchangesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function exchanges(): ExchangesFactory
    {
        return $this->container->make(ExchangesFactory::class);
    }

    /**
     * queues
     * @return QueuesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function queues(): QueuesFactory
    {
        return $this->container->make(QueuesFactory::class);
    }

    /**
     * bindings
     * @return BindingsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function bindings(): BindingsFactory
    {
        return $this->container->make(BindingsFactory::class);
    }

    /**
     * vhosts
     * @return VhostsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function vhosts(): VhostsFactory
    {
        return $this->container->make(VhostsFactory::class);
    }

    /**
     * users
     * @return UsersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function users(): UsersFactory
    {
        return $this->container->make(UsersFactory::class);
    }

    /**
     * Details of the currently authenticated user.
     * @return Response
     */
    public function whoami(): Response
    {
        return $this->client->request(
            'GET',
            ['whoami']
        );
    }

    /**
     * permissions
     * @return PermissionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function permissions(): PermissionsFactory
    {
        return $this->container->make(PermissionsFactory::class);
    }

    /**
     * topicPermissions
     * @return TopicPermissionsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function topicPermissions(): TopicPermissionsFactory
    {
        return $this->container->make(TopicPermissionsFactory::class);
    }

    /**
     * parameters
     * @return ParametersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function parameters(): ParametersFactory
    {
        return $this->container->make(ParametersFactory::class);
    }

    /**
     * globalParameters
     * @return GlobalParametersFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function globalParameters(): GlobalParametersFactory
    {
        return $this->container->make(GlobalParametersFactory::class);
    }

    /**
     * policies
     * @return PoliciesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function policies(): PoliciesFactory
    {
        return $this->container->make(PoliciesFactory::class);
    }

    /**
     * operatorPolicies
     * @return OperatorPoliciesFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function operatorPolicies(): OperatorPoliciesFactory
    {
        return $this->container->make(OperatorPoliciesFactory::class);
    }

    /**
     * Declares a test queue, then publishes and consumes a message.
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
     * Runs basic healthchecks in the current node.
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
     * vhostLimits
     * @return VhostLimitsFactory
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function vhostLimits(): VhostLimitsFactory
    {
        return $this->container->make(VhostLimitsFactory::class);
    }

    /**
     * Details about the OAuth2 configuration.
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
     * Rebalances all queues in all vhosts.
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