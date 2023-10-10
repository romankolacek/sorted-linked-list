<?php
namespace romankolacek;

use Throwable;
use TypeError;

class IntegerSortedLinkedList
{
	private ?Node $head;

	public function __construct()
	{
		$this->head = null;
	}

	public function getHead()
	{
		return $this->head;
	}

	public function add($data)
	{
		try {
			$this->validate($data);

			$newNode = new Node($data);
			if ($this->head == null) {
				$this->head = $newNode;

				return;
			}

			$currentNode = $this->head;

			while ($currentNode->getNext() !== null) {
				$currentNode = $currentNode->getNext();
			}

			$currentNode->setNext($newNode);
		} catch (TypeError) {
			throw new LinkedListException("Data must be an integer");
		} catch (Throwable $exception) {
			throw new LinkedListException($exception->getMessage());
		}
	}

	public function print(string $separator = ', '): string
	{
		$result = '';
		if ($this->head == null) {
			return "List is empty\n";
		}

		$currentNode = $this->head;

		while ($currentNode !== null) {
			$separator   = $currentNode->getNext() !== null ? $separator : '';
			$result     .= $currentNode->getData() . $separator;
			$currentNode = $currentNode->getNext();
		}

		return $result;
	}

	private function validate(int $data): void
	{
		if (! is_int($data)) {
			throw new LinkedListException("Data must be an integer");
		}
	}
}