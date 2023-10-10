<?php

use PHPUnit\Framework\TestCase;
use romankolacek\IntegerSortedLinkedList;
use romankolacek\LinkedListException;

class LinkedListTest extends TestCase {
    public function testEmptyList(): void
    {
        $list = new IntegerSortedLinkedList();
        $this->assertNull($list->getHead());
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

        $this->expectException(LinkedListException::class);
        $list->add('romankolacek');
    }
}