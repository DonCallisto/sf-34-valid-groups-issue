<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Assert\GroupSequence({"Bar", "second"})
 */
class Bar
{
    /**
     * @Assert\NotNull()
     */
    private $first;

    /**
     * @Assert\NotNull(groups={"second"})
     */
    private $second;

    public function __construct($first, $second)
    {
        $this->first = $first;
        $this->second = $second;
    }
}