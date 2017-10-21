<?php

namespace Test\TripSort\Service\Validator;

use TripSort\Service\Validator\ValidationHelper;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class ValidationHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayKeysExistsValidCase()
    {
        $user = [
            'username' => 'fink4O',
            'password' => 'hkdhs777djh',
        ];

        $this->assertTrue(ValidationHelper::arrayKeysExists($user, ['username', 'password']));
    }

    public function testArrayKeysExistsInvalidCase()
    {
        $club = [
            'name' => 'OGC Nice',
            'star' => 'Balotelli',
        ];

        $this->assertFalse(ValidationHelper::arrayKeysExists($club, ['name', 'star', 'budget']));
    }
}
