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

    protected function head(): ?Node
    {
        return $this->head;
    }

    public function print(string $separator = ', '): string
    {
        if ($this->isEmpty()) {
            return "List is empty";
        }

        $result      = '';
        $currentNode = $this->head();

        while ($currentNode !== null) {
            $separator   = $currentNode->hasNext() ? $separator : '';
            $result     .= $currentNode->data() . $separator;
            $currentNode = $currentNode->next();
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

            $currentNode = $this->head();

            if ($currentNode->data() === $newNode->data() && ! $this->allowDuplicities) {
                return;
            }

            if ($currentNode->data() > $newNode->data()) {
                $nextNode   = $currentNode;
                $this->head = $newNode;
                $this->head->setNext($nextNode);

                return;
            }

            while ($currentNode->hasNext()) {
                $nextNode = $currentNode->next();

                if (! $nextNode->hasData()) {
                    $currentNode->setNext($newNode);

                    return;
                }

                if ($newNode->data() < $nextNode->data()) {
                    $newNode->setNext($currentNode->next());
                    $currentNode->setNext($newNode);

                    return;
                }

                $currentNode = $currentNode->next();
            }

            $currentNode->setNext($newNode);
        } catch (TypeError) {
            throw new LinkedListException(sprintf("Value must be type of %s", $this->listType));
        } catch (Throwable $exception) {
            throw new LinkedListException($exception->getMessage());
        }
    }

    public function remove(mixed $data, bool $allOccurencies = false): void
    {
        try {
            $this->validate($data);

            if ($this->isEmpty()) {
                return;
            }

            $currentNode = $this->head();

            if ($currentNode->data() === $data) {
                $this->head = $currentNode->next();

                if (! $allOccurencies) {
                    return;
                }

                $this->remove($data, $allOccurencies);
            }

            while ($currentNode && $currentNode->hasNext()) {
                $nextNode = $currentNode->next();

                if ($nextNode->data() === $data) {
                    $currentNode->setNext($nextNode->next());

                    if (! $allOccurencies) {
                        return;
                    }

                    $this->remove($data, $allOccurencies);
                }

                $currentNode = $currentNode->next();
            }

        } catch (TypeError) {
            throw new LinkedListException(sprintf("Value must be type of %s", $this->listType));
        } catch (Throwable $exception) {
            throw new LinkedListException($exception->getMessage());
        }
    }

    private function isEmpty(): bool
    {
        return ! $this->head();
    }

    abstract protected function validate(mixed $data): void;
}