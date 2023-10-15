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
        $this->setHead(null);
    }

    protected function head(): ?Node
    {
        return $this->head;
    }

    protected function setHead(?Node $head): void
    {
        $this->head = $head;
    }

    public function add(mixed $data): void
    {
        try {
            $this->validate($data);

            $newNode = new Node($data);
            if ($this->isEmpty()) {
                $this->setHead($newNode);

                return;
            }

            $currentNode = $this->head();

            if ($currentNode->data() === $newNode->data() && ! $this->allowDuplicities) {
                return;
            }

            if ($currentNode->data() > $newNode->data()) {
                $nextNode = $currentNode;
                $this->setHead($newNode);
                $this->head()->setNext($nextNode);

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

    public function remove(mixed $data, bool $allOccurrences = false): void
    {
        try {
            $this->validate($data);

            if ($this->isEmpty()) {
                return;
            }

            $currentNode = $this->head();

            if ($currentNode->data() === $data) {
                $this->setHead($currentNode->next());

                if (! $allOccurrences) {
                    return;
                }

                $this->remove($data, $allOccurrences);
            }

            while ($currentNode && $currentNode->hasNext() && $currentNode->next()->data() <= $data) {
                $nextNode = $currentNode->next();

                if ($nextNode->data() === $data) {
                    $currentNode->setNext($nextNode->next());

                    if (! $allOccurrences) {
                        return;
                    }

                    continue;
                }

                $currentNode = $currentNode->next();
            }

        } catch (TypeError) {
            throw new LinkedListException(sprintf("Value must be type of %s", $this->listType));
        } catch (Throwable $exception) {
            throw new LinkedListException($exception->getMessage());
        }
    }

    public function contains(int|string $value): bool
    {
        try {
            $currentNode = $this->head();
            while ($currentNode !== null) {
                if ($currentNode->data() === $value) {
                    return true;
                }

                $currentNode = $currentNode->next();
            }

            return false;
        } catch (Throwable) {
            return false;
        }
    }

    public function pop(): int|string|null
    {
        try {
            if ($this->isEmpty()) {
                return null;
            }

            $currentNode = $this->head();
            while ($currentNode->hasNext()) {
                $nextNode = $currentNode->next();

                if (! $nextNode->hasNext()) {
                    $currentNode->setNext(null);

                    return $nextNode->data();
                }

                $currentNode = $currentNode->next();
            }

            $data = $this->head()->data();
            $this->setHead(null);

            return $data;
        } catch (TypeError) {
            throw new LinkedListException(sprintf("Value must be type of %s", $this->listType));
        } catch (Throwable $exception) {
            throw new LinkedListException($exception->getMessage());
        }
    }

    public function shift(): int|string|null
    {
        if ($this->isEmpty()) {
            return null;
        }

        $data = $this->head()->data();
        $this->setHead($this->head()->hasNext() ? $this->head()->next() : null);

        return $data;
    }

    public function toString(string $separator = ","): string
    {
        $result = $this->toArray();

        return implode($separator, $result);
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->isEmpty()) {
            return $result;
        }

        $currentNode = $this->head();
        while ($currentNode !== null) {
            $result[]    = $currentNode->data();
            $currentNode = $currentNode->next();
        }

        return $result;
    }

    public function size(): int
    {
        return count($this->toArray());
    }

    public function clear(): void
    {
        $this->setHead(null);
    }

    public function isEmpty(): bool
    {
        return ! $this->head();
    }

    abstract protected function validate(mixed $data): void;
}