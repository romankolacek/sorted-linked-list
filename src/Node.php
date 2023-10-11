<?php
namespace romankolacek;

class Node
{
    private int|string $data;
    private ?Node $next;

    public function __construct(int|string $data)
    {
        $this->data = $data;
        $this->next = null;
    }

    public function getData(): int|string
    {
        return $this->data;
    }

    public function setData(int|string $data): void
    {
        $this->data = $data;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }

    public function setNext(?Node $next): void
    {
        $this->next = $next;
    }

    public function hasNext(): bool
    {
        return $this->next !== null;
    }

    public function hasData(): bool
    {
        return $this->data !== null;
    }
}