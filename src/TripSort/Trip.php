<?php

namespace TripSort;

use TripSort\Model\Cards\BoardingCardInterface;
use TripSort\Service\Sorter\CardSorterInterface;
use TripSort\Service\Sorter\CardSorter;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class Trip
{
    /**
     * @var BoardingCardInterface[]
     */
    private $boardingCards = [];

    /**
     * @param BoardingCardInterface[] $boardingCards
     * @param CardSorterInterface|null          $sorter
     */
    public function __construct(array $boardingCards, CardSorterInterface $sorter = null)
    {
        $sorter = $sorter ?: new CardSorter();

        foreach ($boardingCards as $boardingCard) {
            $this->addBoardingCard($boardingCard);
        }

        $this->boardingCards = $sorter->sort($this->boardingCards);
    }

    /**
     * @return Model\Cards\BoardingCardInterface[]
     */
    public function getOrderedBoardingCards(): array
    {
        return $this->boardingCards;
    }

    private function addBoardingCard(BoardingCardInterface $boardingCard): void
    {
        $this->boardingCards[] = $boardingCard;
    }
}
