<?php
namespace romankolacek;

class IntegerSortedLinkedList extends SortedLinkedList
{
    public function __construct(bool $isAscending = true, bool $allowDuplicities = true)
    {
        $this->listType = "integer";
        parent::__construct($isAscending, $allowDuplicities);
    }

    protected function validate(mixed $data): void
    {
        if (! is_int($data)) {
            throw new LinkedListException(sprintf("Value must be type of %s", $this->listType));
        }
    }
}