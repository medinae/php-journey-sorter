<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Place\Place;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface BoardingCardInterface extends ComparableBoardingCardInterface
{
    public function getDeparturePlace(): Place;

    public function getArrivalPlace(): Place;

    public function __toString();
}
