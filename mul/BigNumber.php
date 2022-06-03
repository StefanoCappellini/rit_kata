<?php

namespace Mul;

class BigNumber
{
    private array $inner;

    public function __construct()
    {
        $this->inner = [];
    }

    public static function makeFromInt(int $a): self
    {
        $number = new BigNumber();
        $number->inner = array_map(
            fn($x) => intval($x),
            array_reverse(str_split(strval($a)))
        );
        return $number;
    }

    public static function makeFromIntArray(array $a): self
    {
        $number = new BigNumber();
        $number->inner = array_reverse($a);
        return $number;
    }

    public function nDigits()
    {
        return count($this->inner);
    }

    public function mult(BigNumber $b): BigNumber
    {
        $result = new BigNumber();
        $carry = 0;
        for ($i = 0; $i < $b->nDigits(); $i++) {
            for ($j = 0; $j < $this->nDigits(); $j++) {
                $index = $i + $j;
                $result->inner[$index] = $result->inner[$index] ?? 0;

                $temp = self::basicMultiply($this->inner[$j], $b->inner[$i]) 
                    + $carry 
                    + $result->inner[$index];
                [$carry, $unit] = self::division($temp, 10);
                $result->inner[$index] = $unit;
            }
            if ($carry !== 0) {
                $result->inner[] = $carry;
                $carry = 0;
            }
        }
        return $result;
    }

    public function digits(): array
    {
        return array_reverse($this->inner);
    }

    private static function basicMultiply(int $a, int $b) {
        $result = 0;
        for ($i = 0; $i < $b; $i++) {
            $result += $a;
        }
        return $result;
    }

    private static function division(int $a, int $b) {
        $r = $a;
        $q = 0;
        while ($r >= $b) {
            $r -= $b;
            $q++;
        }
        return [$q, $r];
    }
}
