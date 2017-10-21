<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Place\Place;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class FlightBoardingCard implements BoardingCardInterface
{
    use BoardingCardTrait;

    private $idFlight;
    private $gate;
    private $baggageTicketCounter;

    public function __construct(
        Place $departurePlace,
        Place $arrivalPlace,
        string $seat,
        string $idFlight,
        string $gate,
        string $baggageTicketCounter = null
    ) {
        $this->departurePlace = $departurePlace;
        $this->arrivalPlace = $arrivalPlace;
        $this->seat = $seat;
        $this->idFlight = $idFlight;
        $this->gate = $gate;
        $this->baggageTicketCounter = $baggageTicketCounter ?: 'Automatically transferred';
    }

    public function __toString()
    {
        return sprintf(
            'Take the flight %s from %s to %s. Gate : %s. Seat : %s. Baggage ticket counter : %s.',
            $this->idFlight,
            $this->departurePlace,
            $this->arrivalPlace,
            $this->gate,
            $this->seat,
            $this->baggageTicketCounter
        );
    }
}
