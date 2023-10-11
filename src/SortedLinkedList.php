<?php
namespace romankolacek;

use Throwable;
use TypeError;

abstract class SortedLinkedList
{
	private ?Node $head;
	private bool $allowDuplicities;

	public function __construct(bool $allowDuplicities = true)
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
		$result = '';
		if ($this->head == null) {
			return "List is empty";
		}

		$currentNode = $this->head;

		while ($currentNode !== null) {
			$separator   = $currentNode->getNext() !== null ? $separator : '';
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
			if ($this->head == null) {
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

			while ($currentNode->getNext() !== null) {
				$nextNode = $currentNode->getNext();

				if ($nextNode->getData() === null) {
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

	abstract protected function validate(mixed $data): void;
}