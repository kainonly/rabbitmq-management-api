<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

class QueueOption
{
    /**
     * @var bool
     */
    private bool $auto_delete = false;
    /**
     * @var bool
     */
    private bool $durable = true;
    /**
     * @var array
     */
    private array $arguments = [];
    /**
     * @var string
     */
    private string $node;

    /**
     * QueueOption constructor.
     * @param string $node
     */
    public function __construct(string $node)
    {
        $this->node = $node;
    }

    /**
     * @param bool $auto_delete
     */
    public function setAutoDelete(bool $auto_delete): void
    {
        $this->auto_delete = $auto_delete;
    }

    /**
     * @param bool $durable
     */
    public function setDurable(bool $durable): void
    {
        $this->durable = $durable;
    }


    /**
     * How long a message published to a queue can live before it is discarded
     * @param int $milliseconds
     */
    public function setMessageTTL(int $milliseconds): void
    {
        $this->arguments['x-message-ttl'] = $milliseconds;
    }

    /**
     * How long a queue can be unused for before it is automatically deleted
     * @param int $milliseconds
     */
    public function setAutoExpire(int $milliseconds): void
    {
        $this->arguments['x-expires'] = $milliseconds;
    }

    /**
     * How many (ready) messages a queue can contain before it starts to drop them from its head.
     * @param int $length
     */
    public function setMaxLength(int $length): void
    {
        $this->arguments['x-max-length'] = $length;
    }

    /**
     * Total body size for ready messages a queue can contain before it starts to drop them from its head.
     * @param int $sizeof
     */
    public function setMaxLengthBytes(int $sizeof): void
    {
        $this->arguments['x-max-length-bytes'] = $sizeof;
    }

    /**
     * Sets the queue overflow behaviour.
     * This determines what happens to messages when the maximum length of a queue is reached
     * @param array $values
     */
    public function setOverflow(array $values): void
    {
        $this->arguments['x-overflow'] = implode(',', $values);
    }

    /**
     * Optional name of an exchange to which messages will be republished if they are rejected or expire.
     * @param string $exchange
     */
    public function setDeadLetterExchange(string $exchange): void
    {
        $this->arguments['x-dead-letter-exchange'] = $exchange;
    }

    /**
     * Optional replacement routing key to use when a message is dead-lettered.
     * If this is not set, the message's original routing key will be used.
     * @param string $routingKey
     */
    public function setDeadLetterRoutingKey(string $routingKey): void
    {
        $this->arguments['x-dead-letter-routing-key'] = $routingKey;
    }

    /**
     * If set, makes sure only one consumer at a time
     * consumes from the queue and fails over to another registered consumer
     * in case the active one is cancelled or dies.
     * @param bool $value
     */
    public function setSingleActiveConsumer(bool $value): void
    {
        $this->arguments['x-single-active-consumer'] = $value;
    }

    /**
     * Maximum number of priority levels for the queue to support;
     * if not set, the queue will not support message priorities.
     * @param int $value
     */
    public function setMaxPriority(int $value): void
    {
        $this->arguments['x-max-priority'] = $value;
    }

    /**
     * Set the queue into lazy mode, keeping as many messages as possible on disk to reduce RAM usage;
     * if not set, the queue will keep an in-memory cache to deliver messages as fast as possible.
     */
    public function setQueueLazyMode(): void
    {
        $this->arguments['x-queue-mode'] = 'lazy';
    }

    /**
     * Set the queue into master location mode,
     * determining the rule by which the queue master is located when declared on a cluster of nodes.
     * @param string $value
     */
    public function setQueueMasterLocator(string $value): void
    {
        $this->arguments['x-queue-master-locator'] = $value;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function appendArgument(string $key, $value): void
    {
        $this->arguments[$key] = $value;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return [
            'auto_delete' => $this->auto_delete,
            'durable' => $this->durable,
            'arguments' => (object)$this->arguments,
            'node' => $this->node
        ];
    }
}