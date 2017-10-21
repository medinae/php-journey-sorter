<?php

namespace Test\TripSort;

use TripSort\Trip;
use TripSort\Model\Cards\BusBoardingCard;
use TripSort\Model\Cards\FlightBoardingCard;
use TripSort\Model\Place\Place;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class TripTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideExpectedBoardingCardsAndTrip
     */
    public function testGetOrderedBoardingCards(Trip $trip, array $expectedBoardingCards)
    {
        $this->assertSame($expectedBoardingCards, $trip->getOrderedBoardingCards());
    }

    public function provideExpectedBoardingCardsAndTrip()
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

        $expectedBoardingCards = [$card1, $card2, $card3];

        return [
            [new Trip([$card3, $card2, $card1]), $expectedBoardingCards],
            [new Trip([$card2, $card3, $card1]), $expectedBoardingCards],
            [new Trip([$card1, $card2, $card3]), $expectedBoardingCards]
        ];
    }
}
