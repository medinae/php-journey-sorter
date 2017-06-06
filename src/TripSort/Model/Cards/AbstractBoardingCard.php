<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Cards\Contract\BoardingCardInterface;
use TripSort\Model\Cards\Contract\ComparableBoardingCardInterface;
use TripSort\Model\Place\Contract\PlaceInterface;

/**
 *
 * This abstract superclass will contain all methods and properties
 * that are common for all kinds of boarding card
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
abstract class AbstractBoardingCard implements BoardingCardInterface, ComparableBoardingCardInterface
{
    /**
     * @var PlaceInterface
     */
    protected $departurePlace;

    /**
     * @var PlaceInterface
     */
    protected $arrivalPlace;

    /**
     * @var string
     */
    protected $seat;

    /**
     * Construct boarding card.
     *
     * @param PlaceInterface $departurePlace
     * @param PlaceInterface $arrivalPlace
     * @param string         $seat
     */
    public function __construct(
        PlaceInterface $departurePlace,
        PlaceInterface $arrivalPlace,
        $seat
    ) {
        $this->departurePlace = $departurePlace;
        $this->arrivalPlace = $arrivalPlace;
        $this->seat = $seat ?: 'No seat assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function getArrivalPlace(): PlaceInterface
    {
        return $this->arrivalPlace;
    }

    /**
     * {@inheritdoc}
     */
    public function getDeparturePlace(): PlaceInterface
    {
        return $this->departurePlace;
    }

    /**
     * Get the seat identifier
     *
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }

    /**
     * {@inheritdoc}
     */
    public function hasSameOriginAs($card): bool
    {
        return $this->departurePlace->getName() === $card->getArrivalPlace()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function hasSameDestinationAs($card): bool
    {
        return $this->arrivalPlace->getName() === $card->getDeparturePlace()->getName();
    }

    /**
     * {@inheritdoc}
     */
    abstract public function __toString();
}
