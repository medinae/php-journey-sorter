<?php

namespace TripSort\Model\Cards\Contract;

use TripSort\Model\Place\Contract\PlaceInterface;

/**
 * Interface BoardingCardInterface
 * Have to be implemented by the boarding cards.
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface BoardingCardInterface
{
    /**
     * Getter for departurePlace.
     *
     * @return PlaceInterface
     */
    public function getDeparturePlace();

    /**
     * Getter for arrivalPlace.
     *
     * @return PlaceInterface
     */
    public function getArrivalPlace();

    /**
     * Return boarding card into readable form.
     *
     * @return string
     */
    public function __toString();
}
