<?php

namespace CloudDistrict\TDD\Model;

/**
 * Class Party
 * @package CloudDistrict\TDD\Model
 */
class Party
{
    /**
     * @var string|string
     */
    private $name;

    /**
     * Party constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
