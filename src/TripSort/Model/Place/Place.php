<?php

namespace TripSort\Model\Place;

use TripSort\Model\Place\Contract\PlaceInterface;

/**
 * Class Place
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class Place implements PlaceInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Place constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->name;
    }
}
