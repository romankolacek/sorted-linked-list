<?php
namespace romankolacek;

use Throwable;
use TypeError;

abstract class SortedLinkedList
{
    private ?Node $head;
    private bool $allowDuplicities;
    protected string $listType;

    public function __construct(bool $allowDuplicities)
    {
        $this->allowDuplicities = $allowDuplicities;
        $this->head             = null;
    }

    protected function getHead(): ?Node
    {
        return $this->head;
    }

    public function print(string $separator = ', '): string
    {
        if ($this->isEmpty()) {
            return "List is empty";
        }

        $result      = '';
        $currentNode = $this->head;

        while ($currentNode !== null) {
            $separator   = $currentNode->hasNext() ? $separator : '';
            $result     .= $currentNode->getData() . $separator;
            $currentNode = $currentNode->getNext();
        }

        return $result;
    }

    public function add(mixed $data): void
    {
        try {
            $this->validate($data);

            $newNode = new Node($data);
            if ($this->isEmpty()) {
                $this->head = $newNode;

                return;
            }

            $currentNode = $this->head;

            if ($currentNode->getData() === $newNode->getData() && ! $this->allowDuplicities) {
                return;
            }

            if ($currentNode->getData() > $newNode->getData()) {
                $nextNode   = $currentNode;
                $this->head = $newNode;
                $this->head->setNext($nextNode);

                return;
            }

            while ($currentNode->hasNext()) {
                $nextNode = $currentNode->getNext();

                if (! $nextNode->hasData()) {
                    $currentNode->setNext($newNode);

                    return;
                }

                if ($newNode->getData() < $nextNode->getData()) {
                    $newNode->setNext($currentNode->getNext());
                    $currentNode->setNext($newNode);

                    return;
                }

                $currentNode = $currentNode->getNext();
            }

            $currentNode->setNext($newNode);
        } catch (TypeError) {
            throw new LinkedListException("Data must be an integer");
        } catch (Throwable $exception) {
            throw new LinkedListException($exception->getMessage());
        }
    }

    private function isEmpty(): bool
    {
        return ! $this->getHead();
    }

    abstract protected function validate(mixed $data): void;
}