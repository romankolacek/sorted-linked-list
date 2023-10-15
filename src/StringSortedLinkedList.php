<?php
namespace romankolacek;

class StringSortedLinkedList extends SortedLinkedList
{
    public function __construct(bool $isAscending = true, bool $allowDuplicities = true)
    {
        $this->listType = "string";
        parent::__construct($isAscending, $allowDuplicities);
    }

    protected function validate(mixed $data): void
    {
        if (! is_string($data)) {
            throw new LinkedListException(sprintf("Value must be type of %s", $this->listType));
        }
    }
}