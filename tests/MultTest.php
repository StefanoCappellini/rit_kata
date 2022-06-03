<?php

require __DIR__ . '/../vendor/autoload.php';

use Mul\BigNumber;
use PHPUnit\Framework\TestCase;


final class MultTest extends TestCase
{
    public function testOne()
    {   
        $number = BigNumber::makeFromIntArray([5]);
        $number2 = BigNumber::makeFromIntArray([3]);

        $this->assertSame($number->mult($number2)->digits(), [1, 5]);

        $number = BigNumber::makeFromIntArray([3,5]);
        $number2 = BigNumber::makeFromIntArray([3,5]);

        $this->assertSame($number->mult($number2)->digits(), [1,2,2,5]);

        $factorial = BigNumber::makeFromIntArray([1,0,0]);
        for($i = 99; $i > 0; $i--) {
            $factorial = $factorial->mult(BigNumber::makeFromInt($i));
        }
        $this->assertSame(
            join('', $factorial->digits()),
            '93326215443944152681699238856266700490715968264381621468592963895217599993229915608941463976156518286253697920827223758251185210916864000000000000000000000000'
        );
    }
}