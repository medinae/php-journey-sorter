<?php

namespace TripSort\Service\Validator;

/**
 * Helper for data validation
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class ValidationHelper
{
    /**
     * Check is keys exists in an array
     *
     * @param array $array
     * @param array $keys
     *
     * @return bool
     */
    public static function arrayKeysExists(array $array, $keys)
    {
        $count = 0;

        if (!is_array($keys)) {
            $keys = func_get_args();
            array_shift($keys);
        }

        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $count ++;
            }
        }

        return count($keys) === $count;
    }
}
