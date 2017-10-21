<?php

namespace TripSort\Service\Loader;

/**
 * New loaders have to implement this interface.
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface BoardingCardLoaderInterface
{
    public function loadCards(string $data): array;
}
