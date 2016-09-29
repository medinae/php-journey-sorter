<?php

namespace TripSort\Model\Place\Contract;

/**
 * Interface PlaceInterface
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface PlaceInterface
{
    /**
     * Return the Place name
     *
     * @return string
     */
    public function getName();

    /**
     * Return the place name in a readable form.
     *
     * @return string
     */
    public function __toString();
}
