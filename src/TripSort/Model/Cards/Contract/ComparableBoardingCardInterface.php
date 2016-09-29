<?php

namespace TripSort\Model\Cards\Contract;

/**
 * Interface ComparableBoardingCardInterface
 * Have to be implemented by the comparable boarding cards.
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface ComparableBoardingCardInterface
{
    /**
     * Check if current card has same origin as the given card
     *
     * @param BoardingCardInterface $card
     *
     * @return bool
     */
    public function hasSameOriginAs($card);

    /**
     * Check if current card has same destination as the given card
     *
     * @param BoardingCardInterface $card
     *
     * @return bool
     */
    public function hasSameDestinationAs($card);
}
