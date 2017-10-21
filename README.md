[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0d184d8b-49b6-4969-ad1a-ffbafb23714c/mini.png)](https://insight.sensiolabs.com/projects/0d184d8b-49b6-4969-ad1a-ffbafb23714c)
[![Build Status](https://travis-ci.org/medinae/php-journey-sorter.svg?branch=master)](https://travis-ci.org/medinae/php-journey-sorter)
# Journey

by AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>

This API enable you to sort your unordered boarding cards.

## Installation && Tests

Build the docker image and run it to make it a container :

```bash
 docker build -t medinae/journey .
 docker run medinae/journey

```

## How to use the API

1 . Load the boarding cards objects from your valid input data :

```php
    $loader = new JsonBoardingCardLoader();
    $boardingCards = $loader->loadCards($jsonCards);
```

2 . Pass your boardingCards to a new Trip object. You can also inject your specific sorter who implements BoardingCardLoaderInterface. By default, the existing sorter will be used.
    
```php
    $trip = new Trip($boardingCards);
    // OR
    $trip = new Trip($boardingCards, new MyAmazingSorter());
```

3 . Get your ordered boarding cards (NOTE : The toString method is also implemented if you want to display the trip information into human readable form) :

```php
    $trip->getOrderedBoardingCards();
```

4 . Enjoy !

    
## Enhancement

You can create some new boarding card objects by implementing BoardingCardInterface. Be careful, if you want your boarding card object to be sortable by the API sorter, don't forget to implements ComparableBoardingCardInterface.
Also, add it in the loaders factory.

Example :     
    
```php
    class FerryBoardingCard implements BoardingCardInterface
    {
        use BoardingCardTrait;
        
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
```
    
Then, the loader have to be change in order to create ferry boarding cards with it : 

```php
    class JsonBoardingCardLoader implements BoardingCardLoaderInterface
    {
        public function loadCards($json)
        {
            // ...
        }
    
        protected function createCard(array $cardData)
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
```

Regarding the loader, i have implemented a JsonBoardingCardLoader who create boarding cards objects cards from a valid JSON input
Furthermore, the boarding card data might come from multiple formats (e.g. XML), so I created a BoardingCardLoaderInterface with a loadCards() method.

Then, a possible enhancement of the API can be an XMLBoardingCardLoader like :
    
```php
    class XMLBoardingCardLoader implements BoardingCardLoaderInterface
    {
        public function loadCards(string $xml): array
        {
            // Logic to create boarding cards objects cards from XML
        }
    }
```


Finally, it's also possible to extend the code by creating new sorters by implementing CardSorterInterface like :

```php
    class AwesomeSorter implements CardSorterInterface
    {
        public function sort(array $boardingCards): array
        {
            // Your awesome algorithm
        }
    }
```
