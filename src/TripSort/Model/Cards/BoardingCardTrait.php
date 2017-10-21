<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Place\Place;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
trait BoardingCardTrait
{
    /** @var Place */
    private $departurePlace;

    /** @var Place */
    private $arrivalPlace;

    /** @var string */
    private $seat;

    public function getArrivalPlace(): Place
    {
        return $this->arrivalPlace;
    }

    public function getDeparturePlace(): Place
    {
        return $this->departurePlace;
    }

    public function getSeat(): string
    {
        return $this->seat;
    }

    public function hasSameOriginAs(BoardingCardInterface $card): bool
    {
        return $this->departurePlace->getName() === $card->getArrivalPlace()->getName();
    }

    public function hasSameDestinationAs(BoardingCardInterface $card): bool
    {
        return $this->arrivalPlace->getName() === $card->getDeparturePlace()->getName();
    }
}
