<?php

namespace Log;

class Map implements \IteratorAggregate
{
    private array $map = [];
    private int $totalBytes = 0;
    private int $totalRequests = 0;

    public function newRequest(SingleInputValue $request)
    {
        $ip = $request->getIp();
        if (!isset($this->map[$ip])) {
            $this->map[$ip] = new SingleOutputValue($ip);
        }
        $item = $this->map[$ip];
        $item->newRequest($request);
        $this->totalBytes += $request->getBytes();
        $this->totalRequests++;
    }

    public function getIterator(): \ArrayIterator
    {
        $toIterate = array_values($this->map);
        usort($toIterate, function(SingleOutputValue $a, SingleOutputValue $b) {
            if ($a->getNumberOfRequests() > $b->getNumberOfRequests()) {
                return -1;
            }
            return $a->getNumberOfRequests() === $b->getNumberOfRequests() ? 0 : 1;
        });
        return (new \ArrayObject($toIterate))->getIterator();
    }

    public function getTotalRequests(): int
    {
        return $this->totalRequests;
    }

    public function getTotalBytes(): int
    {
        return $this->totalBytes;
    }
}
