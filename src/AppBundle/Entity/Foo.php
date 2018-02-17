<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Foo
{
    /**
     * @Assert\Valid(groups={"Bar"})
     */
    private $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }
}