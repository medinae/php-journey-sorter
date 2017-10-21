<?php

namespace TripSort\Service\Validator;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class ValidationHelper
{
    public static function arrayKeysExists(array $array, array $keys): bool
    {
        return 0 === count(array_diff($keys, array_keys($array)));
    }
}
