<?php

namespace TripSort\Service\Loader\Contract;

use TripSort\Model\Cards\Contract\BoardingCardInterface;

/**
 * New loader have to implement this interface.
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface BoardingCardLoaderInterface
{
    /**
     * Load boarding card objects from input format
     *
     * @param mixed $data
     *
     * @return BoardingCardInterface[]
     */
    public function loadCards($data): array;
}
