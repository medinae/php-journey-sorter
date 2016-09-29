<?php

namespace TripSort;

use TripSort\Model\Cards\Contract\ComparableBoardingCardInterface;
use TripSort\Service\Sorter\Contract\CardSorterInterface;
use TripSort\Service\Sorter\CardSorter;

/**
 * Take boarding cards, sort it thanks to the injected sorter and offer various output
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class Trip
{
    /**
     * @var CardSorterInterface
     */
    protected $sorter;

    /**
     * @var ComparableBoardingCardInterface[]
     */
    protected $boardingCards = [];

    /**
     * Trip constructor.
     *
     * @param ComparableBoardingCardInterface[]  $boardingCards
     * @param CardSorterInterface|null $sorter
     */
    public function __construct(
        $boardingCards,
        CardSorterInterface $sorter = null
    ) {
        $this->sorter = $sorter ? $sorter : new CardSorter();

        foreach ($boardingCards as $boardingCard) {
            $this->addBoardingCard($boardingCard);
        }

        $this->boardingCards = $this->sorter->sort($this->boardingCards);
    }

    /**
     * Add a boarding card and ensure that Trip boardingCards are always sorted.
     *
     * @param ComparableBoardingCardInterface $boardingCard
     */
    protected function addBoardingCard(ComparableBoardingCardInterface $boardingCard)
    {
        $this->boardingCards[] = $boardingCard;
    }

    /**
     * Return the ordered boarding cards - array format
     *
     * @return Model\Cards\Contract\ComparableBoardingCardInterface[]
     */
    public function getOrderedBoardingCards()
    {
        return $this->boardingCards;
    }

    /**
     * Print the trip information into human readable form.
     *
     * @return string
     */
    public function __toString()
    {
        $output = null;

        foreach ($this->boardingCards as $boardingCard) {
            $output .= $boardingCard.PHP_EOL;
        }

        $output .= 'You have arrived at your final destination.';

        return $output;
    }
}
