<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Place\Place;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class TrainBoardingCard implements BoardingCardInterface
{
    use BoardingCardTrait;

    private $idTrain;

    public function __construct(
        Place $departurePlace,
        Place $arrivalPlace,
        string $seat,
        string $idTrain
    ) {
        $this->departurePlace = $departurePlace;
        $this->arrivalPlace = $arrivalPlace;
        $this->seat = $seat;
        $this->idTrain = $idTrain;
    }

    public function __toString()
    {
        return sprintf(
            'Take train %s from %s to %s. Seat : %s.',
            $this->idTrain,
            $this->departurePlace,
            $this->arrivalPlace,
            $this->seat
        );
    }
}
