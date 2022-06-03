<?php

namespace Log;

class SingleInputValue
{
    public function __construct(
        private string $ip,
        private string $status,
        private int $timestamp,
        private int $bytes
    ) {}

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isOk(): bool
    {
        return $this->status === 'OK';
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function isDateWithinRange($date): bool
    {
        $ts = (new \DateTime())
            ->setTimestamp($this->timestamp)
            ->format('Y-m-d');
        return $ts === ($date)->format('Y-m-d');
    }

    public function getBytes(): int
    {
        return $this->bytes;
    }
}