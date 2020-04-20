<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

class MessageOption
{
    /**
     * @var int
     */
    private int $count = 5;
    /**
     * @var bool
     */
    private bool $ack = false;
    /**
     * @var bool
     */
    private bool $auto_encoding = true;
    /**
     * @var int
     */
    private int $truncate = 50000;

    /**
     * controls the maximum number of messages to get
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    /**
     * determines whether the messages will be removed from the queue
     * @param bool $ack
     */
    public function setAck(bool $ack): void
    {
        $this->ack = $ack;
    }

    /**
     * auto or base64
     * @param bool $auto_encoding
     */
    public function setAutoEncoding(bool $auto_encoding): void
    {
        $this->auto_encoding = $auto_encoding;
    }

    /**
     * is present it will truncate the message payload if it is larger than the size given (in bytes)
     * @param int $truncate
     */
    public function setTruncate(int $truncate): void
    {
        $this->truncate = $truncate;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return [
            'count' => $this->count,
            'ackmode' => $this->ack ? 'ack_requeue_false' : 'ack_requeue_true',
            'encoding' => $this->auto_encoding ? 'auto' : 'base64',
            'truncate' => $this->truncate
        ];
    }
}