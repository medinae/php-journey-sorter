<?php

namespace Test\TripSort\Service\Loader;

use TripSort\Model\Cards\BusBoardingCard;
use TripSort\Model\Cards\FlightBoardingCard;
use TripSort\Model\Cards\TrainBoardingCard;
use TripSort\Service\Loader\Contract\BoardingCardLoaderInterface;
use TripSort\Service\Loader\JsonBoardingCardLoader;

/**
 * JsonBoardingCardLoader unit test class
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class JsonBoardingCardLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JsonBoardingCardLoader
     */
    private $loader;

    protected function setUp()
    {
        $this->loader = new JsonBoardingCardLoader();
    }

    public function testIfClassImplementsBoardingCardLoaderInterface()
    {
        $this->assertInstanceOf(BoardingCardLoaderInterface::class, $this->loader);
    }

    public function testLoadCardsWithValidData()
    {
        $trainData = [
            'type' => 'train',
            'from' => 'Paris',
            'to' => 'Marseille',
            'seat' => '45B',
            'id' => '78A',
        ];

        $busData = [
            'type' => 'bus',
            'from' => 'Marseille',
            'to' => 'Valencia',
            'seat' => null
        ];

        $flightData = [
            'type' => 'flight',
            'from' => 'Valencia',
            'to' => 'Algiers',
            'seat' => '3A',
            'id' => 'SK455',
            'gate' => '45B',
            'baggage' => '344',
        ];

        $jsonCards = json_encode([$trainData, $busData, $flightData]);
        $generatedCards = $this->loader->loadCards($jsonCards);

        $this->assertCount(3, $generatedCards);

        $this->assertInstanceOf(TrainBoardingCard::class, $generatedCards[0]);
        $this->assertInstanceOf(BusBoardingCard::class, $generatedCards[1]);
        $this->assertInstanceOf(FlightBoardingCard::class, $generatedCards[2]);

        $this->assertEquals($trainData['seat'], $generatedCards[0]->getSeat());
        $this->assertEquals('No seat assignment', $generatedCards[1]->getSeat());
        $this->assertEquals($flightData['seat'], $generatedCards[2]->getSeat());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage No valid data. Impossible to load boarding cards.
     */
    public function testLoadCardsWithoutData()
    {
        $this->loader->loadCards(json_encode([]));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Missing required keys to create boarding card. Check type, from, to and seat keys.
     */
    public function testLoadCardsWithoutType()
    {
        $invalidJson = json_encode([
            [
                'from' => 'Shangai',
                'to' => 'Hong Kong',
                'seat' => '1A',
            ]
        ]);

        $this->loader->loadCards($invalidJson);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Missing required keys to create FlightBoardingCard. Check id, gate and baggage.
     */
    public function testLoadFlightCardWithoutGate()
    {
        $invalidJson = json_encode([
            [
                'type' => 'flight',
                'from' => 'Shangai',
                'to' => 'Singapore',
                'seat' => '1A',
                'id' => 'SD23',
                'baggage' => '3A',
            ]
        ]);

        $this->loader->loadCards($invalidJson);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Missing id key to create TrainBoardingCard.
     */
    public function testLoadTrainCardWithoutId()
    {
        $invalidJson = json_encode([
            [
                'type' => 'train',
                'from' => 'Kyoto',
                'to' => 'Tokyo',
                'seat' => '1A',
            ]
        ]);

        $this->loader->loadCards($invalidJson);
    }

    /**
     * @expectedException \TripSort\Exception\UnknownBoardingCardTypeException
     * @expectedExceptionMessage JSON Loading : Unknown board card type open-source
     */
    public function testLoadCardsWithInvalidType()
    {
        $invalidJson = json_encode([
            [
                'type' => 'open-source',
                'from' => 'Kyoto',
                'to' => 'Tokyo',
                'seat' => '1A',
            ]
        ]);

        $this->loader->loadCards($invalidJson);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid input data. Please provide valid JSON.
     */
    public function testLoadCardsWithoutJSONInput()
    {
        $invalidData = new \stdClass();

        $this->loader->loadCards($invalidData);
    }
}
