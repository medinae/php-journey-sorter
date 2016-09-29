# Trip Sorter

by AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>

This API enable you to sort your unordered boarding cards.

## Installation

Go to the root directory of the project, open a terminal and execute it in order to get the required vendors :

```bash
 composer install
```

## How to use the API

1 . Load the boarding cards objects from your valid input data :

    $loader = new JsonBoardingCardLoader();
    $boardingCards = $loader->loadCards($jsonCards);
    
2 . Pass your boardingCards to a new Trip object. You can also inject your specific sorter who implements BoardingCardLoaderInterface. By default, the existing sorter will be used.
    
    $trip = new Trip($boardingCards);
    // OR
    $trip = new Trip($boardingCards, new MyAmazingSorter());

3 . Get your ordered boarding cards (NOTE : The toString method is also implemented if you want to display the trip information into human readable form) :

    $trip->getOrderedBoardingCards();

4 . Enjoy !

    
## Enhancement

You can create some new boarding card objects by implementing BoardingCardInterface. Be careful, if you want your boarding card object to be sortable by the API sorter, don't forget to implements ComparableBoardingCardInterface.
Also, add it in the loaders factory.

Then, if your boarding card contain a seat property, keep calm and use AbstractBoardingCard !

Example :     
    
    class FerryBoardingCard extends AbstractBoardingCard
    {
    
        private $isGoldClass;
        
        public function __toString()
        {
            return sprintf(
                'Take ferry from %s to %s. Seat : %s. Gold class : %s',
                $this->departurePlace,
                $this->arrivalPlace,
                $this->seat,
                ($this->isGoldClass) ? 'YES' : 'NO'
            );
        }
    }
    
Then, the loader have to be change in order to create ferry boarding cards with it : 

    class JsonBoardingCardLoader implements BoardingCardLoaderInterface
    {
        public function loadCards($json)
        {
            // ...
        }
    
        protected function createCards(array $cardData)
        {
            // ...
                case 'ferry':
                    // data validation
    
                    return new FerryBoardingCard(
                        new Place($cardData['from']),
                        new Place($cardData['to']),
                        $cardData['seat'],
                        $cardData['isGoldClass']
                    );
                default:
                    throw new UnknownBoardingCardTypeException('JSON Loading : Unknown board card type '.$type);
            }
        }
    }

Regarding the loader, i have implemented a JsonBoardingCardLoader who create boarding cards objects cards from a valid JSON input
Furthermore, the boarding card data might come from multiple formats (e.g. XML), so I created a BoardingCardLoaderInterface with a loadCards() method.

Then, a possible enhancement of the API can be an XMLBoardingCardLoader like :
    
    class JsonBoardingCardLoader implements BoardingCardLoaderInterface
    {
        public function loadCards($json)
        {
            // Logic to create boarding cards objects cards from XML
        }
    }


Finally, it's also possible to extend the code by creating new sorters by implementing CardSorterInterface like :

    class AwesomeSorter implements CardSorterInterface
    {
        public function sort(array $boardingCards)
        {
            // Your awesome algorithm
        }
    }

## Tests


The tests were performed with PHPUnit

1 . Open a console

2 . Move to the project root directory

2 . Execute the cmd

```bash
 vendor/bin/phpunit -c .
```

## Doc

Generate the documentation : 

```bash
 vendor/phpdocumentor/phpdocumentor/bin/phpdoc -d src/ -t docs/api
```

## Dev infos


- PHP 5.5
- PhpStorm 10.0.3



Mail  : ak.bouadjadja@gmail.com
Skype : fink40

