<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Place\Contract\PlaceInterface;

/**
 * Flight boarding card
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class FlightBoardingCard extends AbstractBoardingCard
{
    /**
     * @var string
     */
    protected $idFlight;

    /**
     * @var string
     */
    protected $gate;

    /**
     * @var string
     */
    protected $baggageTicketCounter;

    /**
     * FlightBoardingCard constructor.
     *
     * @param PlaceInterface $departurePlace
     * @param PlaceInterface $arrivalPlace
     * @param string         $seat
     * @param string         $idFlight
     * @param string         $gate
     * @param string         $baggageTicketCounter
     */
    public function __construct(
        PlaceInterface $departurePlace,
        PlaceInterface $arrivalPlace,
        $seat,
        $idFlight,
        $gate,
        $baggageTicketCounter
    ) {
        parent::__construct($departurePlace, $arrivalPlace, $seat);

        $this->seat = $seat;
        $this->idFlight = $idFlight;
        $this->gate = $gate;
        $this->baggageTicketCounter = $baggageTicketCounter ?: 'Automatically transferred';
    }

    /**
     * {@inheritdoc}
     */
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
