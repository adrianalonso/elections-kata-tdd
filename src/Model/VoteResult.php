<?php

namespace CloudDistrict\TDD\Model;

/**
 * Class VoteResult
 * @package CloudDistrict\TDD\Model
 */
class VoteResult
{
    /**
     * @var array
     */
    private $results;

    /**
     * VoteResult constructor.
     */
    public function __construct()
    {
        $this->results = [];
    }

    /**
     * @param array $element
     */
    public function addResult(array $element)
    {
        $this->results[] = $element;
    }
}
