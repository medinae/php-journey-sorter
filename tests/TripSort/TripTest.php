<?php

namespace TripSort\Trip;

use TripSort\Model\Cards\BusBoardingCard;
use TripSort\Model\Cards\Contract\ComparableBoardingCardInterface;
use TripSort\Model\Cards\FlightBoardingCard;
use TripSort\Model\Place\Place;
use TripSort\Trip;

/**
 * Class TripTest
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class TripTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Trip
     */
    private $trip;

    /**
     * @var ComparableBoardingCardInterface[]
     */
    private $expectedBoardingCards;

    /**
     * Before a test method is tun, this function is calling.
     */
    protected function setUp()
    {
        $card1 = new BusBoardingCard(
            new Place('London'),
            new Place('Keynes'),
            '3G'
        );

        $card2 = new BusBoardingCard(
            new Place('Keynes'),
            new Place('Newcastle'),
            '33A'
        );

        $card3 = new FlightBoardingCard(
            new Place('Newcastle'),
            new Place('Warsaw'),
            '12C',
            'NEWA334',
            '3A',
            '4B'
        );

        $this->trip = new Trip([$card3, $card2, $card1]);
        $this->expectedBoardingCards = [$card1, $card2, $card3];
    }

    public function testGetOrderedBoardingCards()
    {
        $this->assertEquals($this->expectedBoardingCards, $this->trip->getOrderedBoardingCards());
    }

    public function testToString()
    {
        $expectedString = <<<BLOC
Take the airport bus from London to Keynes. Seat : 3G
Take the airport bus from Keynes to Newcastle. Seat : 33A
Take the flight NEWA334 from Newcastle to Warsaw. Gate : 3A. Seat : 12C. Baggage ticket counter : 4B.
You have arrived at your final destination.
BLOC;

        $this->assertEquals($expectedString, $this->trip->__toString());
    }
}
