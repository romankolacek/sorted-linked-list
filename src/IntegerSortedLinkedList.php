<?php
namespace romankolacek;

class IntegerSortedLinkedList extends SortedLinkedList
{
	protected function validate(mixed $data): void
	{
		if (! is_int($data)) {
			throw new LinkedListException("Data must be an integer");
		}
	}
}