<?php

namespace TripSort\Service\Sorter\Contract;

use TripSort\Model\Cards\Contract\ComparableBoardingCardInterface;

/**
 * New sorters have to implements this interface
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface CardSorterInterface
{
    /**
     * Sort a boarding cards array from origin to destination.
     *
     * @param ComparableBoardingCardInterface[] $cards
     */
    public function sort(array $cards): array;
}
