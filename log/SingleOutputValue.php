<?php

namespace Log;

class SingleOutputValue
{
    private int $numberOfRequests;
    private int $numberOfBytes;
    private string $ip;

    public function __construct(string $ip)
    {
        $this->numberOfRequests = 0;
        $this->numberOfBytes = 0;
        $this->ip = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function newRequest(SingleInputValue $inputValue)
    {
        $this->numberOfRequests++;
        $this->numberOfBytes += $inputValue->getBytes();
    }

    public function getNumberOfRequests(): int
    {
        return $this->numberOfRequests;
    }

    public function getNumberOfBytes(): int
    {
        return $this->numberOfBytes;
    }

    public function getPercentageOfTotalRequests(int $total): float
    {
        return $this->getNumberOfRequests() / $total;
    }

    public function getPercentageOfTotalBytes(int $total): float
    {
        return $this->getNumberOfBytes() / $total;
    }
}