<?php

use PHPUnit\Framework\TestCase;
use romankolacek\LinkedListException;
use romankolacek\IntegerSortedLinkedList;

class IntegerLinkedListTest extends TestCase {
    public function testEmptyList(): void
    {
        $list = new IntegerSortedLinkedList();
        $this->assertEquals('List is empty', $list->print());
    }

    public function testThreeIntValuesInList(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(1);
        $list->add(2);
        $list->add(3);
        $this->assertEquals("1, 2, 3", $list->print());
    }

    public function testStringValueInIntegerList(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(1);
        $list->add(2);

        $this->expectException(LinkedListException::class);
        $list->add('romankolacek');
    }

    public function testCorrectSortingInList(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(1);
        $list->add(2);
        $list->add(4);
        $list->add(5);
        $list->add(3);
        $list->add(6);
        $this->assertEquals("1, 2, 3, 4, 5, 6", $list->print());
    }

    public function testCorrectSortingUsingDescendingValuesInList(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(6);
        $list->add(5);
        $list->add(4);
        $list->add(3);
        $list->add(2);
        $list->add(1);
        $this->assertEquals("1, 2, 3, 4, 5, 6", $list->print());
    }

    public function testSortingWithDuplicitiesInList(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(6);
        $list->add(6);
        $list->add(4);
        $list->add(4);
        $list->add(1);
        $list->add(1);
        $this->assertEquals("1, 1, 4, 4, 6, 6", $list->print());
    }

    public function testSortingWithoutDuplicitiesInList(): void
    {
        $list = new IntegerSortedLinkedList(false);
        $list->add(6);
        $list->add(6);
        $list->add(4);
        $list->add(4);
        $list->add(1);
        $list->add(1);
        $this->assertEquals("1, 4, 6", $list->print());
    }

    public function testCorrectSortingUsingNegativeValuesInList(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(6);
        $list->add(-6);
        $list->add(4);
        $list->add(0);
        $list->add(-4);
        $list->add(-1);
        $list->add(1);
        $this->assertEquals("-6, -4, -1, 0, 1, 4, 6", $list->print());
    }

    public function testPrintSeparator(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(5);
        $list->add(1);
        $list->add(2);
        $list->add(3);
        $this->assertEquals("1|2|3|5", $list->print('|'));
    }
}