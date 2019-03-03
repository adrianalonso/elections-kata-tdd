<?php

namespace CloudDistrict\TDD\Strategy;

use CloudDistrict\TDD\Model\VoteResult;

interface StrategyInterface
{
    public function calculate(): VoteResult;
}
