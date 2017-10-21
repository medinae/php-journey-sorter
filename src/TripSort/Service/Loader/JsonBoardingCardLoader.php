<?php

namespace TripSort\Service\Loader;

use TripSort\Model\Cards\BusBoardingCard;
use TripSort\Exception\UnknownBoardingCardTypeException;
use TripSort\Model\Cards\BoardingCardInterface;
use TripSort\Model\Cards\FlightBoardingCard;
use TripSort\Model\Cards\TrainBoardingCard;
use TripSort\Model\Place\Place;
use TripSort\Service\Validator\ValidationHelper as Validator;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class JsonBoardingCardLoader implements BoardingCardLoaderInterface
{
    public function loadCards(string $json): array
    {
        try {
            $data = json_decode($json, true);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Invalid input data. Please provide valid JSON.');
        }

        if (empty($data)) {
            throw new \InvalidArgumentException('No valid data. Impossible to load boarding cards.');
        }

        $cards = [];
        foreach ($data as $cardData) {
            $cards[] = $this->createCard($cardData);
        }

        return $cards;
    }

    private function createCard(array $cardData): BoardingCardInterface
    {
        if (!Validator::arrayKeysExists($cardData, ['type', 'from', 'to', 'seat'])) {
            throw new \InvalidArgumentException(
                'Missing required keys to create boarding card. Check type, from, to and seat keys.'
            );
        }

        $type = $cardData['type'];

        switch ($type) {
            case 'flight':
                if (!Validator::arrayKeysExists($cardData, ['id', 'gate', 'baggage'])) {
                    throw new \InvalidArgumentException(
                        'Missing required keys to create FlightBoardingCard. Check id, gate and baggage.'
                    );
                }

                return new FlightBoardingCard(
                    new Place($cardData['from']),
                    new Place($cardData['to']),
                    $cardData['seat'],
                    $cardData['id'],
                    $cardData['gate'],
                    $cardData['baggage']
                );
            case 'bus':
                return new BusBoardingCard(
                    new Place($cardData['from']),
                    new Place($cardData['to']),
                    $cardData['seat']
                );
            case 'train':
                if (!array_key_exists('id', $cardData)) {
                    throw new \InvalidArgumentException('Missing id key to create TrainBoardingCard.');
                }

                return new TrainBoardingCard(
                    new Place($cardData['from']),
                    new Place($cardData['to']),
                    $cardData['seat'],
                    $cardData['id']
                );
            default:
                throw new UnknownBoardingCardTypeException('JSON Loading : Unknown board card type '.$type);
        }
    }
}
