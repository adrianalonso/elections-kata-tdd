<?php

namespace CloudDistrict\TDD\Calculator;

use CloudDistrict\TDD\Exception\InvalidStrategyException;
use CloudDistrict\TDD\Model\Scrutiny;
use CloudDistrict\TDD\Model\VoteResult;
use CloudDistrict\TDD\Strategy\DhondtStrategy;
use CloudDistrict\TDD\Strategy\HareStrategy;
use CloudDistrict\TDD\Strategy\PercentageStrategy;
use CloudDistrict\TDD\Strategy\StrategyInterface;

/**
 * Class VoteCalculator
 * @package CloudDistrict\TDD\Calculator
 */
class VoteCalculator
{

    /**
     * @var StrategyInterface
     */
    protected $strategy;

    /**
     * @var Scrutiny[]
     */
    protected $scrutiny = [];

    /**
     * @var int
     */
    private $numSeats;

    /**
     * VoteCalculator constructor.
     * @param array $scrutiny
     * @param int $numSeats
     * @param string $strategyIdentifier
     * @throws \Exception
     */
    public function __construct(array $scrutiny, int $numSeats, $strategyIdentifier = "dhondt")
    {
        $this->scrutiny = $scrutiny;
        $this->numSeats = $numSeats;

        if ($strategyIdentifier === "dhondt") {
            $this->strategy = new DhondtStrategy($this->scrutiny, $this->numSeats);
        }

        if ($strategyIdentifier === "hare") {
            $this->strategy = new HareStrategy($this->scrutiny, $this->numSeats);
        }

        if (!$this->strategy) {
            throw new InvalidStrategyException("Strategy not found");
        }
    }

    /**
     * @return VoteResult
     */
    public function calculate(): VoteResult
    {
        return $this->strategy->calculate();
    }
}
