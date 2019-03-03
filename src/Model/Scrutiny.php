<?php

namespace CloudDistrict\TDD\Model;

/**
 * Class Scrutiny
 * @package CloudDistrict\TDD\Model
 */
class Scrutiny
{

    /**
     * @var Party
     */
    private $party;

    /**
     * @var int
     */
    private $votes;

    /**
     * Scrutiny constructor.
     * @param Party $party
     * @param int $int
     */
    public function __construct(Party $party, int $votes)
    {
        $this->party = $party;
        $this->votes = $votes;
    }

    /**
     * @return Party
     */
    public function getParty(): Party
    {
        return $this->party;
    }

    /**
     * @param Party $party
     */
    public function setParty(Party $party): void
    {
        $this->party = $party;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        return $this->votes;
    }

    /**
     * @param int $votes
     */
    public function setVotes(int $votes): void
    {
        $this->votes = $votes;
    }
}
