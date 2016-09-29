<?php

namespace Test\TripSort\Service\Validator;

use TripSort\Service\Validator\ValidationHelper;

/**
 * ValidationHelper unit test class
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CardSorterTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayKeysExistsValidCase()
    {
        $user = [
            'username' => 'fink4O',
            'password' => 'hkdhs777djh',
        ];

        $this->assertTrue(ValidationHelper::arrayKeysExists($user, 'username', 'password'));
    }

    public function testArrayKeysExistsInvalidCase()
    {
        $club = [
            'name' => 'OGC Nice',
            'star' => 'Balotelli',
        ];

        $this->assertFalse(ValidationHelper::arrayKeysExists($club, 'name', 'star', 'budget'));
    }
}
