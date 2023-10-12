## Installation
```bash
composer require romankolacek/sorted-linked-list
```

## Example
```php
use romankolacek\SortedLinkedLIst;

$sortedLinkedList = new IntegerSortedLinkedList();
$sortedLinkedList->add(1);
$sortedLinkedList->add(5);
$sortedLinkedList->add(4);

# get result as string
$stringResult = $sortedLinkedList->toString(", "); // "1, 4, 5"
# get result as array
$arrayResult = $sortedLinkedList->toArray(); // [1, 4, 5]
# get size
$size = $sortedLinkedList->size(); // 3
# pop last value
$lastValue = $sortedLinkedList->pop(); // 5
# shift first value
$firstValue = $sortedLinkedList->shift(); // 1
# check if is empty
$isEmpty = $sortedLinkedList->isEmpty(); // false
# check if contains value
$containsValue = $sortedLinkedList->contains(4); // true
# clear list
$sortedLinkedList->clear();