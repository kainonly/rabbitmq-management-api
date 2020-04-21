<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\MessageOption;
use RabbitMQ\API\Common\QueueOption;
use RabbitMQ\API\Common\Response;

class QueuesFactory extends Factory
{
    /**
     * A list of all queues.
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['queues', urlencode($vhost)]
        );
    }

    /**
     * Get an individual queue
     * @param string $name
     * @param string $vhost
     * @return Response
     */
    public function get(string $name, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['queues', urlencode($vhost), $name]
        );
    }

    /**
     * Add an individual queue
     * @param string $name
     * @param QueueOption $option
     * @param string $vhost
     * @return Response
     */
    public function put(string $name, QueueOption $option, string $vhost): Response
    {
        return $this->client->request(
            'PUT',
            ['queues', urlencode($vhost), $name],
            null,
            $option->getBody()
        );
    }

    /**
     * Delete an individual queue
     * @param string $name
     * @param string $vhost
     * @param bool $empty
     * @param bool $unused
     * @return Response
     */
    public function delete(
        string $name,
        string $vhost,
        bool $empty = true,
        bool $unused = true
    ): Response
    {
        return $this->client->request(
            'DELETE',
            ['queues', urlencode($vhost), $name],
            [
                'if-empty' => $empty,
                'if-unused' => $unused
            ]
        );
    }

    /**
     * A list of all bindings on a given queue
     * @param string $name
     * @param string $vhost
     * @return Response
     */
    public function getBindings(string $name, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['queues', urlencode($vhost), $name, 'bindings'],
        );
    }

    /**
     * purge contents of a queue
     * @param string $name
     * @param string $vhost
     * @return Response
     */
    public function purgeMessage(string $name, string $vhost): Response
    {
        return $this->client->request(
            'DELETE',
            ['queues', urlencode($vhost), $name, 'contents'],
        );
    }

    /**
     * Actions that can be taken on a queue
     * @param string $name
     * @param string $action
     * @param string $vhost
     * @return Response
     */
    public function action(string $name, string $action, string $vhost): Response
    {
        return $this->client->request(
            'POST',
            ['queues', urlencode($vhost), $name, 'actions'],
            null,
            [
                'action' => $action
            ]
        );
    }

    /**
     * Get messages from a queue.
     * @param string $name
     * @param MessageOption $option
     * @param string $vhost
     * @return Response
     */
    public function getMessage(string $name, MessageOption $option, string $vhost): Response
    {
        return $this->client->request(
            'POST',
            ['queues', urlencode($vhost), $name, 'get'],
            null,
            $option->getBody()
        );
    }
}