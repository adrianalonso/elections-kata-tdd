<?php

namespace CloudDistrict\TDD\Strategy;

use CloudDistrict\TDD\Model\Party;
use CloudDistrict\TDD\Model\Scrutiny;
use CloudDistrict\TDD\Model\VoteResult;
use Webmozart\Assert\Assert;

/**
 * Class AbstractStrategy
 * @package CloudDistrict\TDD\Strategy
 */
abstract class AbstractStrategy implements StrategyInterface
{
    /**
     * @var array
     */
    protected $scrutiny;

    /**
     * @var int
     */
    protected $numSeats;

    /**
     * DhornStrategy constructor.
     * @param array $scrutiny
     */
    public function __construct(array $scrutiny, int $numSeats)
    {
        $this->setScrutiny($scrutiny);
        $this->setNumSeats($numSeats);
    }

    /**
     * @return array
     */
    public function getScrutiny(): array
    {
        return $this->scrutiny;
    }

    /**
     * @param array $scrutiny
     */
    public function setScrutiny(array $scrutiny): void
    {
        Assert::greaterThan(count($scrutiny), 0, "Invalid Scrutiny. You need pass elements");
        $this->scrutiny = $scrutiny;
    }

    /**
     * @return int
     */
    public function getNumSeats(): int
    {
        return $this->numSeats;
    }

    /**
     * @param int $numSeats
     */
    public function setNumSeats(int $numSeats): void
    {
        Assert::greaterThan($numSeats, 0, "Invalid Seats. You need greather than 0");

        $this->numSeats = $numSeats;
    }

    /**
     * @param $table
     * @return mixed
     */
    protected function orderTable(array &$table, $key): array
    {
        usort($table, function ($a, $b) use ($key) {
            return $a[$key] < $b[$key];
        });

        return $table;
    }

    /**
     * @return int
     */
    protected function getNumVotesTotal()
    {
        $numVotes = 0;
        foreach ($this->scrutiny as $item) {
            $numVotes += $item->getVotes();
        }

        return $numVotes;
    }
}
