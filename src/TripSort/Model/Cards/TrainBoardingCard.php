<?php

namespace TripSort\Model\Cards;

use TripSort\Model\Place\Contract\PlaceInterface;

/**
 * Class Train boarding card
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class TrainBoardingCard extends AbstractBoardingCard
{
    /**
     * @var string
     */
    protected $idTrain;

    /**
     * TrainBoardingCard constructor.
     *
     * @param PlaceInterface $departurePlace
     * @param PlaceInterface $arrivalPlace
     * @param string         $seat
     * @param string         $idTrain
     */
    public function __construct(
        PlaceInterface $departurePlace,
        PlaceInterface $arrivalPlace,
        $seat,
        $idTrain
    ) {
        parent::__construct($departurePlace, $arrivalPlace, $seat);
        $this->idTrain = $idTrain;
    }

    /**
     * {@inheritdoc}
     */
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
