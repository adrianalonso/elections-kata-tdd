<?php

use CloudDistrict\TDD\Calculator\VoteCalculator;
use CloudDistrict\TDD\Exception\InvalidStrategyException;
use CloudDistrict\TDD\Model\Scrutiny;
use CloudDistrict\TDD\Model\VoteResult;
use PHPUnit\Framework\TestCase;
use CloudDistrict\TDD\Model\Party;

/**
 * Class VoteCalculatorTest
 */
class VoteCalculatorTest extends TestCase
{

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidScrutiny()
    {
        $calculator = new VoteCalculator([], 1, "dhondt");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidSeats()
    {
        $calculator = new VoteCalculator([1, 1], 0, "dhondt");
    }


    public function testInvalidStrategy()
    {
        $this->expectException(InvalidStrategyException::class);
        $calculator = new VoteCalculator([1, 1], 1, "invalid");
    }

    /**
     * @dataProvider dhondtScrutinyProvider
     */
    public function testDhondtVoteCaculatorTest($scrutiny, $numSeats, $strategy, $expectedResult)
    {
        $calculator = new VoteCalculator($scrutiny, $numSeats, $strategy);
        $result = $calculator->calculate();

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider hareScrutinyProvider
     */
    public function testHareVoteCaculatorTest($scrutiny, $numSeats, $strategy, $expectedResult)
    {
        $calculator = new VoteCalculator($scrutiny, $numSeats, "hare");
        $result = $calculator->calculate();

        $this->assertEquals($expectedResult, $result);
    }

    public function dhondtScrutinyProvider()
    {
        $numSeats = 7;
        $partyA = new Party("Partido A");
        $partyB = new Party("Partido B");
        $partyC = new Party("Partido C");
        $partyD = new Party("Partido D");
        $partyE = new Party("Partido E");

        $scrutiny1 = [
            new Scrutiny($partyA, 500000),
            new Scrutiny($partyB, 300000),
            new Scrutiny($partyC, 150000),
            new Scrutiny($partyD, 50000),
            new Scrutiny($partyE, 10000),
        ];

        $expectedResult1 = new VoteResult();
        $expectedResult1->addResult([$partyA, 4]);
        $expectedResult1->addResult([$partyB, 2]);
        $expectedResult1->addResult([$partyC, 1]);
        $expectedResult1->addResult([$partyD, 0]);
        $expectedResult1->addResult([$partyE, 0]);

        $scrutiny2 = [
            new Scrutiny($partyA, 340000),
            new Scrutiny($partyB, 280000),
            new Scrutiny($partyC, 160000),
            new Scrutiny($partyD, 60000),
            new Scrutiny($partyE, 15000),
        ];

        $expectedResult2 = new VoteResult();
        $expectedResult2->addResult([$partyA, 3]);
        $expectedResult2->addResult([$partyB, 3]);
        $expectedResult2->addResult([$partyC, 1]);
        $expectedResult2->addResult([$partyD, 0]);
        $expectedResult2->addResult([$partyE, 0]);

        return [
            [$scrutiny1, $numSeats, "dhondt", $expectedResult1],
            [$scrutiny2, $numSeats, "dhondt", $expectedResult2],
        ];
    }

    public function hareScrutinyProvider()
    {
        $numSeats = 21;
        $partyA = new Party("Partido A");
        $partyB = new Party("Partido B");
        $partyC = new Party("Partido C");
        $partyD = new Party("Partido D");
        $partyE = new Party("Partido E");
        $partyF = new Party("Partido F");
        $partyG = new Party("Partido G");

        $scrutiny = [
            new Scrutiny($partyA, 391000),
            new Scrutiny($partyB, 311000),
            new Scrutiny($partyC, 184000),
            new Scrutiny($partyD, 73000),
            new Scrutiny($partyE, 27000),
            new Scrutiny($partyF, 12000),
            new Scrutiny($partyG, 2000),

        ];

        $expectedResult = new VoteResult();
        $expectedResult->addResult([$partyA, 8]);
        $expectedResult->addResult([$partyB, 6]);
        $expectedResult->addResult([$partyC, 4]);
        $expectedResult->addResult([$partyD, 2]);
        $expectedResult->addResult([$partyE, 1]);
        $expectedResult->addResult([$partyF, 0]);
        $expectedResult->addResult([$partyG, 0]);

        return [
            [$scrutiny, $numSeats, "hare", $expectedResult],
        ];
    }
}
