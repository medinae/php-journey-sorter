<?php

namespace TripSort\Model\Cards;

/**
 * Bus boarding card
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class BusBoardingCard extends AbstractBoardingCard
{
    /**
     * {@inheritdoc}
     */
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
