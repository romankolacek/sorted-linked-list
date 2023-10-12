## Installation
```bash
composer require romankolacek/sorted-linked-list
```

### Linked list types
You can use two types of linked lists
- IntegerSortedLinkedList
-- accepts only integer values, in other way LinkedListException is thrown
- StringSortedLinkedList
-- accepts only string values, in other way LinkedListException is thrown

## Example of IntegerSortedLinkedList
```php
use romankolacek\SortedLinkedList;

$sortedLinkedList = new IntegerSortedLinkedList();
$sortedLinkedList->add(1);
$sortedLinkedList->add(5);
$sortedLinkedList->add(4);
$sortedLinkedList->add(8);
$sortedLinkedList->add("Alfa") // SortedLinkedListException is thrown

# get result as string
$stringResult = $sortedLinkedList->toString(", "); // "1, 4, 5, 8"
# remove value if found
$sortedLinkedList->remove(8);
# remove all occurrences of value 
$sortedLinkedList->remove(8, true)
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
```
## Example of StringSortedLinkedList
It is the same as IntegerSortedLinkedList, just validates strings as allowed values in method add()
```php 
$sortedLinkedList = new StringSortedLinkedList(true); //allow duplicit values
$sortedLinkedList->add("Alfa");
$sortedLinkedList->add("Bravo");
$sortedLinkedList->add("Charlie");
$sortedLinkedList->add(42) // SortedLinkedListException is thrown

# get result as string
$stringResult = $sortedLinkedList->toString("/"); // "Alfa/Bravo/Charlie"
...
```

### LinkedLists accepts duplicities as default.
```php
new IntegerSortedLinkedList() // accepts duplicities => 1, 1, 2, 3, 3, 4
new IntegerSortedLinkedList(false) // don't accept duplicities => 1, 2, 3
```