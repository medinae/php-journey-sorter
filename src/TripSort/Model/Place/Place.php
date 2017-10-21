<?php

namespace TripSort\Model\Place;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class Place
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
}
