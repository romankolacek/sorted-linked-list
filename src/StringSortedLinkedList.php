<?php
namespace romankolacek;

class StringSortedLinkedList extends SortedLinkedList
{
    public function __construct(bool $allowDuplicities = true)
    {
        $this->listType = 'string';
        parent::__construct($allowDuplicities);
    }

    protected function validate(mixed $data): void
    {
        if (! is_string($data)) {
            throw new LinkedListException(sprintf("Data must be a %s", $this->listType));
        }
    }
}