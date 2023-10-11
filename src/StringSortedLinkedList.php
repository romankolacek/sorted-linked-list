<?php
namespace romankolacek;

class StringSortedLinkedList extends SortedLinkedList
{
	protected function validate(mixed $data): void
	{
		if (! is_string($data)) {
			throw new LinkedListException("Data must be a string");
		}
	}
}