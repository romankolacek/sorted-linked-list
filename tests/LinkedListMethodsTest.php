<?php

use PHPUnit\Framework\TestCase;
use romankolacek\IntegerSortedLinkedList;
use romankolacek\StringSortedLinkedList;

class LinkedListMethodsTest extends TestCase {
    public function testToArray(): void
    {
        $list = new IntegerSortedLinkedList();
        $list->add(6);
        $list->add(6);
        $list->add(4);
        $list->add(4);
        $list->add(1);
        $list->add(1);
        $arrayList = $list->toArray();
        $this->assertEquals(6, count($arrayList));
    }

    public function testIsEmpty(): void
    {
        $list = new StringSortedLinkedList();
        $this->assertTrue($list->isEmpty());

        $list->add("Alfa");
        $this->assertFalse($list->isEmpty());
    }

    public function testSize(): void
    {
        $list = new StringSortedLinkedList();
        $this->assertEquals(0, $list->size());

        $list->add("Alfa");
        $this->assertEquals(1, $list->size());
    }

    public function testClear(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Alfa");
        $list->add("Bravo");
        $list->add("Charlie");
        $this->assertEquals(3, $list->size());
        $list->clear();
        $this->assertEquals(0, $list->size());
    }

    public function testPop(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Alfa");
        $list->add("Bravo");
        $list->add("Charlie");
        $this->assertEquals(3, $list->size());
        $popValue = $list->pop();
        $this->assertEquals("Charlie", $popValue);
        $this->assertEquals(2, $list->size());
        $popValue = $list->pop();
        $this->assertEquals("Bravo", $popValue);
        $this->assertEquals(1, $list->size());
        $popValue = $list->pop();
        $this->assertEquals("Alfa", $popValue);
        $this->assertEquals(0, $list->size());
        $popValue = $list->pop();
        $this->assertEquals(null, $popValue);
    }

    public function testShift(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Alfa");
        $list->add("Bravo");
        $list->add("Charlie");
        $this->assertEquals(3, $list->size());
        $shiftValue = $list->shift();
        $this->assertEquals("Alfa", $shiftValue);
        $this->assertEquals(2, $list->size());
        $shiftValue = $list->shift();
        $this->assertEquals("Bravo", $shiftValue);
        $this->assertEquals(1, $list->size());
        $shiftValue = $list->shift();
        $this->assertEquals("Charlie", $shiftValue);
        $this->assertEquals(0, $list->size());
        $shiftValue = $list->shift();
        $this->assertEquals(null, $shiftValue);
    }

    public function testContains(): void
    {
        $list = new StringSortedLinkedList();
        $list->add("Alfa");
        $list->add("Bravo");
        $list->add("Charlie");
        $this->assertTrue($list->contains("Alfa"));
        $this->assertTrue($list->contains("Bravo"));
        $this->assertTrue($list->contains("Charlie"));
        $this->assertFalse($list->contains("Delta"));
        $this->assertFalse($list->contains(42));

        $list = new IntegerSortedLinkedList();
        $list->add(1);
        $list->add(2);
        $list->add(3);
        $this->assertTrue($list->contains(1));
        $this->assertTrue($list->contains(2));
        $this->assertTrue($list->contains(3));
        $this->assertFalse($list->contains(4));
        $this->assertFalse($list->contains("Alfa"));
    }
}