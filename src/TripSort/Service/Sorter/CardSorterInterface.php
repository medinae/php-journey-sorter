<?php

namespace TripSort\Service\Sorter;

use TripSort\Model\Cards\ComparableBoardingCardInterface;

/**
 * New sorters have to implements this interface
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface CardSorterInterface
{
    /**
     * @param ComparableBoardingCardInterface[] $cards
     *
     * @return array
     */
    public function sort(array $cards): array;
}
