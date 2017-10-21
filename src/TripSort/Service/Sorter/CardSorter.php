<?php

namespace TripSort\Service\Sorter;

use TripSort\Exception\NonSortableBoardingCardsException;

/**
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CardSorter implements CardSorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(array $boardingCards): array
    {
        if (empty($boardingCards)) {
            throw new \InvalidArgumentException('No boarding cards to sort.');
        }

        $input = $boardingCards;
        $sortedCards = [array_pop($boardingCards)];

        while (0 < $countInput = count($input)) {
            foreach ($input as $key => $card) {
                if (end($sortedCards)->hasSameDestinationAs($card)) {
                    $sortedCards[] = $card;

                    unset($input[$key]);
                } elseif (reset($sortedCards)->hasSameOriginAs($card)) {
                    array_unshift($sortedCards, $card);

                    unset($input[$key]);
                }

                if (1 === count($input)) {
                    unset($input[$key]);
                }
            }

            if (count($input) === $countInput) {
                throw new NonSortableBoardingCardsException(
                    'Multiple boarding cards with same origin/destination or impossible to find the following one.'
                );
            }
        }

        return $sortedCards;
    }
}
