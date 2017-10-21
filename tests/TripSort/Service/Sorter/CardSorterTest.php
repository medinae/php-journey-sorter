<?php

namespace Test\TripSort\Service\Sorter;

use TripSort\Model\Cards\BusBoardingCard;
use TripSort\Model\Cards\FlightBoardingCard;
use TripSort\Model\Cards\TrainBoardingCard;
use TripSort\Model\Place\Place;
use TripSort\Service\Sorter\CardSorterInterface;
use TripSort\Service\Sorter\CardSorter;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CardSorterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CardSorter
     */
    private $sorter;

    protected function setUp()
    {
        $this->sorter = new CardSorter();
    }

    public function testIfClassImplementsBoardingCardLoaderInterface()
    {
        $this->assertInstanceOf(CardSorterInterface::class, $this->sorter);
    }

    /**
     * @dataProvider provideBoardingCards
     */
    public function testSort(array $boardingCards, array $expectedBoardingCards)
    {
        $sortedBoardingCards = $this->sorter->sort($boardingCards);

        $this->assertSame($expectedBoardingCards, $sortedBoardingCards);
    }

    /**
     * @expectedException \TripSort\Exception\NonSortableBoardingCardsException
     * @expectedExceptionMessage Multiple boarding cards with same origin/destination or impossible to find the following one.
     */
    public function testSortWithNonSortableCards()
    {
        $card1 = new BusBoardingCard(
            new Place('Lyon'),
            new Place('St Etienne'),
            '33A'
        );

        $card2 = new BusBoardingCard(
            new Place('Lille'),
            new Place('Bruxelles'),
            '33A'
        );

        $this->sorter->sort([$card1, $card2]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage No boarding cards to sort.
     */
    public function testSortEmptyArray()
    {
        $this->sorter->sort([]);
    }

    /**
     * @expectedException \TripSort\Exception\NonSortableBoardingCardsException
     * @expectedExceptionMessage Multiple boarding cards with same origin/destination or impossible to find the following one.
     */
    public function testSortWithMultipleSimilarDestination()
    {
        $card1 = new BusBoardingCard(
            new Place('Deira'),
            new Place('Dubai'),
            '33A'
        );

        $card2 = new BusBoardingCard(
            new Place('Dubai'),
            new Place('Abu Dhabi'),
            '33A'
        );

        $card3 = new BusBoardingCard(
            new Place('Dubai'),
            new Place('Al Ain'),
            '33A'
        );

        $this->sorter->sort([$card2, $card1, $card3]);
    }

    public function provideBoardingCards()
    {
        $card1 = new FlightBoardingCard(
            new Place('London'),
            new Place('Dubai'),
            '12C',
            'LDDXB334',
            '3A',
            '4B'
        );

        $card2 = new BusBoardingCard(
            new Place('Dubai'),
            new Place('Abu Dhabi'),
            '33A'
        );

        $card3 = new FlightBoardingCard(
            new Place('Abu Dhabi'),
            new Place('Kuta'),
            '12C',
            'ADKT334',
            '3A',
            '4B'
        );

        $card4 = new TrainBoardingCard(
            new Place('Kuta'),
            new Place('Seminyiak'),
            '5D',
            'KUSEM2'
        );

        $card5 = new FlightBoardingCard(
            new Place('Kuta'),
            new Place('Sydney'),
            '12C',
            'KUSY7667',
            '3A',
            '4B'
        );

        $card6 = new BusBoardingCard(
            new Place('Sydney'),
            new Place('Pearth'),
            '12C'
        );

        $boardingCardsSet1 = [$card3, $card2, $card4, $card1];
        $boardingCardsSet2 = [$card4, $card1, $card3, $card2];
        $boardingCardsSet3 = [$card6, $card5, $card3];
        $boardingCardsSet4 = [$card6, $card5];

        $expectedSet1 = [$card1, $card2, $card3, $card4];
        $expectedSet2 = [$card3, $card5, $card6];
        $expectedSet3 = [$card5, $card6];

        return [
            [$boardingCardsSet1, $expectedSet1],
            [$boardingCardsSet2, $expectedSet1],
            [$boardingCardsSet3, $expectedSet2],
            [$boardingCardsSet4, $expectedSet3],
            [[$card5], [$card5]]
        ];
    }
}
