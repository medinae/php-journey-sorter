<?php

namespace TripSort\Service\Sorter;

use TripSort\Exception\NonSortableBoardingCardsException;
use TripSort\Service\Sorter\Contract\CardSorterInterface;

/**
 * This class contains a sorting algorithm for a boarding cards array.
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CardSorter implements CardSorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(array $boardingCards)
    {
        if (empty($boardingCards)) {
            throw new \Exception('No boarding cards to sort.');
        }

        $input = null;
        $output = null;

        $input = $boardingCards;

        if (0 === count($output)) {
            $output = array(
                array_pop($boardingCards),
            );
        }

        while (0 < count($input)) {
            $countInput = count($input);

            foreach ($input as $key => $card) {
                if (end($output)->hasSameDestinationAs($card)) {
                    array_push($output, $card);

                    unset($input[$key]);
                } elseif (reset($output)->hasSameOriginAs($card)) {
                    array_unshift($output, $card);

                    unset($input[$key]);
                }

                if (1 == count($input)) {
                    unset($input[$key]);
                }
            }

            if (count($input) == $countInput) {
                throw new NonSortableBoardingCardsException(
                    'Multiple boarding cards with same origin/destination or impossible to find the following one.'
                );
            }
        }

        return $output;
    }
}
