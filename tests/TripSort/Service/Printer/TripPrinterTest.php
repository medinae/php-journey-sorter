<?php

namespace Test\TripSort\Service\Printer;

use TripSort\Model\Cards\BusBoardingCard;
use TripSort\Model\Cards\FlightBoardingCard;
use TripSort\Model\Place\Place;
use TripSort\Service\Printer\TripPrinter;
use TripSort\Trip;

class TripPrinterTest extends \PHPUnit_Framework_TestCase
{
    /** @var TripPrinter */
    private $tripPrinter;

    protected function setUp()
    {
        $this->tripPrinter = new TripPrinter();
    }

    /**
     * @dataProvider provideTripAndExpectedString
     */
    public function testPrint(Trip $trip, string $expectedString)
    {
        ob_start();
        $this->tripPrinter->print($trip);

        $output = ob_get_clean();

        $this->assertSame($expectedString, $output);
    }

    /**
     * @dataProvider provideTripAndExpectedString
     */
    public function testGetPrintableFormat(Trip $trip, string $expectedString)
    {
        $this->assertSame($expectedString, $this->tripPrinter->getPrintableFormat($trip));
    }

    public function provideTripAndExpectedString()
    {
        $card1 = new BusBoardingCard(
            new Place('Lyon'),
            new Place('Marseille'),
            '1A'
        );

        $card2 = new BusBoardingCard(
            new Place('Marseille'),
            new Place('Barcelona'),
            '2B'
        );

        $card3 = new FlightBoardingCard(
            new Place('Barcelona'),
            new Place('Warsaw'),
            '1C',
            'BAWA334',
            '3F',
            '10'
        );

        $expectedString1 = <<<BLOC
Take the airport bus from Lyon to Marseille. Seat : 1A
Take the airport bus from Marseille to Barcelona. Seat : 2B
Take the flight BAWA334 from Barcelona to Warsaw. Gate : 3F. Seat : 1C. Baggage ticket counter : 10.
You have arrived at your final destination.
BLOC;

        $card4 = new FlightBoardingCard(
            new Place('Boston'),
            new Place('Las Vegas'),
            '2E',
            'BOVE334',
            '4C'
        );

        $card5 = new FlightBoardingCard(
            new Place('Las Vegas'),
            new Place('Miami'),
            '1C',
            'VEMI334',
            '3F',
            '14'
        );

        $expectedString2 = <<<BLOC
Take the flight BOVE334 from Boston to Las Vegas. Gate : 4C. Seat : 2E. Baggage ticket counter : Automatically transferred.
Take the flight VEMI334 from Las Vegas to Miami. Gate : 3F. Seat : 1C. Baggage ticket counter : 14.
You have arrived at your final destination.
BLOC;


        return [
            [new Trip([$card1, $card2, $card3]), $expectedString1],
            [new Trip([$card4, $card5]), $expectedString2],
        ];
    }
}
