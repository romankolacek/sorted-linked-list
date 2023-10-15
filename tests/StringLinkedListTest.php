<?php

use PHPUnit\Framework\TestCase;
use romankolacek\LinkedListException;
use romankolacek\StringSortedLinkedList;

class StringLinkedListTest extends TestCase {
    public function testEmptyList(): void
    {
        $list = new StringSortedLinkedList();
        $this->assertEquals("", $list->toString());
        $this->assertEquals(0, $list->size());
    }

    public function testThreeStringValuesInList(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Alfa");
        $list->add("Bravo");
        $list->add("Charlie");
        $this->assertEquals("Alfa,Bravo,Charlie", $list->toString());
    }

    public function testIntValueInStringList(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Alfa");
        $list->add("Bravo");

        $this->expectException(LinkedListException::class);
        $list->add(3);
    }

    public function testStringSortedLinkedList(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Bravo");
        $list->add("Alfa");
        $list->add("Delta");
        $list->add("Charlie");
        $list->add("Echo");
        $this->assertEquals("Alfa,Bravo,Charlie,Delta,Echo", $list->toString());
    }

    public function testSortingUsingDescendingValuesInList(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Foxtrot");
        $list->add("Echo");
        $list->add("Delta");
        $list->add("Charlie");
        $list->add("Bravo");
        $list->add("Alfa");
        $this->assertEquals("Alfa,Bravo,Charlie,Delta,Echo,Foxtrot", $list->toString());
    }

    public function testSortingWithDuplicitiesInList(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Foxtrot");
        $list->add("Foxtrot");
        $list->add("Echo");
        $list->add("Echo");
        $list->add("Bravo");
        $list->add("Bravo");
        $this->assertEquals("Bravo,Bravo,Echo,Echo,Foxtrot,Foxtrot", $list->toString());
    }

    public function testSortingWithoutDuplicitiesInList(): void
    {
        $list = new StringSortedLinkedList(true, false);
        $list->add("Foxtrot");
        $list->add("Foxtrot");
        $list->add("Echo");
        $list->add("Echo");
        $list->add("Bravo");
        $list->add("Bravo");
        $this->assertEquals("Bravo,Echo,Foxtrot", $list->toString());
    }

    public function testSortingUsingStringyIntegersValuesInList(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("0");
        $list->add("5");
        $list->add("6");
        $list->add("4");
        $list->add("2");
        $list->add("8");
        $list->add("-5");
        $this->assertEquals("-5,0,2,4,5,6,8", $list->toString());
    }

    public function testPrintSeparator(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Charlie");
        $list->add("Bravo");
        $list->add("Alfa");
        $this->assertEquals("Alfa|Bravo|Charlie", $list->toString("|"));
    }
}