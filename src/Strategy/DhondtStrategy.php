<?php

namespace CloudDistrict\TDD\Strategy;

use CloudDistrict\TDD\Model\Party;
use CloudDistrict\TDD\Model\VoteResult;

/**
 * Class DhornStrategy
 * @package CloudDistrict\TDD\Strategy
 */
class DhondtStrategy extends AbstractStrategy
{

    /**
     * @return VoteResult
     */
    public function calculate(): VoteResult
    {
        $voteResult = new VoteResult();

        $table = $this->calculateTable();
        $orderedTable = $this->orderTable($table, 1);
        $firstNElements = $this->takeFirstNElements($orderedTable, $this->numSeats);

        foreach ($this->scrutiny as $scrutiny) {
            $voteResult->addResult([
                $scrutiny->getParty(),
                $this->countNumOccurrencesInArray($scrutiny->getParty(), $firstNElements)
            ]);
        }

        return $voteResult;
    }


    /**
     * @return array
     */
    private function calculateTable(): array
    {
        $table = [];
        for ($i = 1; $i <= $this->numSeats; $i++) {
            foreach ($this->scrutiny as $element) {
                $table[] = [$element->getParty(), $element->getVotes() / $i];
            }
        }

        return $table;
    }

    /**
     * @param $table
     * @param int $numElements
     * @return array
     */
    private function takeFirstNElements($table, $numElements = 1)
    {
        return array_slice($table, 0, $numElements);
    }

    /**
     * @param Party $party
     * @param $result
     * @return int
     */
    private function countNumOccurrencesInArray(Party $party, $result): int
    {
        return count(array_filter($result, function ($e) use ($party) {
            return $e[0] === $party;
        }));
    }
}
