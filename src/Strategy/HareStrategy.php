<?php

namespace CloudDistrict\TDD\Strategy;

use CloudDistrict\TDD\Model\VoteResult;

/**
 * Class HareStrategy
 * @package CloudDistrict\TDD\Strategy
 */
class HareStrategy extends AbstractStrategy
{

    /**
     * @return VoteResult
     */
    public function calculate(): VoteResult
    {
        $voteResult = new VoteResult();

        $table = $this->calculateTable();
        $table = $this->applyModCalculator($table);

        foreach ($table as $item) {
            $voteResult->addResult([$item[0], $item[1]]);
        }

        return $voteResult;
    }

    /**
     * @return array
     */
    private function calculateTable(): array
    {
        $table = [];
        $cocient = $this->getNumVotesTotal() / $this->numSeats;

        foreach ($this->scrutiny as $element) {
            $seatsByCocient = floor($element->getVotes() / $cocient);
            $votesByRest = $element->getVotes() - ($this->getNumVotesTotal() / $this->numSeats * $seatsByCocient);

            $table[] = [
                $element->getParty(),
                $seatsByCocient,
                $votesByRest
            ];
        }

        return $table;
    }

    /**
     * @param array $table
     * @return array
     */
    private function applyModCalculator(array &$table): array
    {
        $seatsDistributed = 0;
        foreach ($table as $itemTable) {
            list($party, $seats, $votesByRest) = $itemTable;
            $seatsDistributed += $seats;
        }
        $extraSeats = $this->numSeats - $seatsDistributed;

        $orderedTable = $this->orderTable($table, 2);
        for ($i = 0; $i < $extraSeats; $i++) {
            $orderedTable[$i][1]++;
        }

        $orderedTable = $this->orderTable($orderedTable, 1);

        return $orderedTable;
    }
}
