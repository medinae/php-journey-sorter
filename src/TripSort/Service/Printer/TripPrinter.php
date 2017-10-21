<?php

namespace TripSort\Service\Printer;

use TripSort\Trip;

class TripPrinter
{
    public function print(Trip $trip): void
    {
        echo $this->getPrintableFormat($trip);
    }

    public function getPrintableFormat(Trip $trip): string
    {
        $output = null;

        foreach ($trip->getOrderedBoardingCards() as $boardingCard) {
            $output .= $boardingCard.PHP_EOL;
        }

        $output .= 'You have arrived at your final destination.';

        return $output;
    }
}
