<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Place\Place;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class BusBoardingCard implements BoardingCardInterface
{
    use BoardingCardTrait;

    public function __construct(Place $departurePlace, Place $arrivalPlace, string $seat = null)
    {
        $this->departurePlace = $departurePlace;
        $this->arrivalPlace = $arrivalPlace;
        $this->seat = $seat ?: 'No seat assignment';
    }

    public function __toString()
    {
        return sprintf(
            'Take the airport bus from %s to %s. Seat : %s',
            $this->departurePlace,
            $this->arrivalPlace,
            $this->seat
        );
    }
}
