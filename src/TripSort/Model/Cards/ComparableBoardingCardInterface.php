<?php

namespace TripSort\Model\Cards;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface ComparableBoardingCardInterface
{
    public function hasSameOriginAs(BoardingCardInterface $card): bool;

    public function hasSameDestinationAs(BoardingCardInterface $card): bool;
}
