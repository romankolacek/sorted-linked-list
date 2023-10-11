<?php
namespace romankolacek;

class IntegerSortedLinkedList extends SortedLinkedList
{
    public function __construct(bool $allowDuplicities = true)
    {
        $this->listType = 'integer';
        parent::__construct($allowDuplicities);
    }

    protected function validate(mixed $data): void
    {
        if (! is_int($data)) {
            throw new LinkedListException(sprintf("Value must be type of %s", $this->listType));
        }
    }
}