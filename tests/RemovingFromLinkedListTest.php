<?php

use PHPUnit\Framework\TestCase;
use romankolacek\IntegerSortedLinkedList;
use romankolacek\StringSortedLinkedList;

class RemovingFromLinkedListTest extends TestCase {
    public function testRemovingWithIntegerDuplicitiesInList(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(6);
        $list->add(6);
        $list->add(4);
        $list->add(4);
        $list->add(1);
        $list->add(1);
        $list->remove(4);
        $this->assertEquals("1, 1, 4, 6, 6", $list->print());

        $list->remove(6, true);
        $this->assertEquals("1, 1, 4", $list->print());

        $list->remove(1, true);
        $this->assertEquals("4", $list->print());

        $list->remove(4, true);
        $this->assertEquals("List is empty", $list->print());
    }

    public function testRemovingWithStringDuplicitiesInList(): void
    {
        $list = new StringSortedLinkedList();
        $list->add('Alfa');
        $list->add('Alfa');
        $list->add('Foxtrot');
        $list->add('Foxtrot');
        $list->add('Bravo');
        $list->add('Bravo');
        $this->assertEquals("Alfa, Alfa, Bravo, Bravo, Foxtrot, Foxtrot", $list->print());
        $list->remove('Foxtrot');
        $this->assertEquals("Alfa, Alfa, Bravo, Bravo, Foxtrot", $list->print());

        $list->remove('Foxtrot', true);
        $this->assertEquals("Alfa, Alfa, Bravo, Bravo", $list->print());

        $list->remove('Alfa', true);
        $this->assertEquals("Bravo, Bravo", $list->print());

        $list->remove("Bravo", true);
        $this->assertEquals("List is empty", $list->print());
    }
}