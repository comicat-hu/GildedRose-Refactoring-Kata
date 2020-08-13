<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase {
    public function testFoo() {
        $items      = [new NormalItem("foo", 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $items[0]->getName());
    }

    public function testQualityNeverIsNegative() {
        $items      = [new NormalItem("foo", 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->getQuality());     
    }

    public function testSulfurasCouldNotBeSold() {
        $items = [new SulfurasItem("Sulfuras, Hand of Ragnaros", 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(10, $items[0]->getSellIn());
    }

    public function testSulfurasCouldNotDecreaseQuality() {
        $items = [new SulfurasItem("Sulfuras, Hand of Ragnaros", 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(10, $items[0]->getQuality());
    }

    public function testQualityCouldNotBeMoreThanFifty() {
        $items = [new AgedBrieItem("Aged Brie", 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testItemWithDatePassedQualityDecreaseByTwice() {
        $items = [new NormalItem("foo", -1, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(38, $items[0]->getQuality());
    }

    public function testAgedBrieIncreaseQualityWhenItGetsOlder() {
        $items = [new AgedBrieItem("Aged Brie", 1, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(41, $items[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassed() {
        $items = [new AgedBrieItem("Aged Brie", -1, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(42, $items[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassedAndNotMoreThanFifty() {
        $items = [new AgedBrieItem("Aged Brie", -1, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanTen() {
        $items = [new BackstagePassesItem("Backstage passes to a TAFKAL80ETC concert", 10, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(42, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSix() {
        $items = [new BackstagePassesItem("Backstage passes to a TAFKAL80ETC concert", 6, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(42, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFive() {
        $items = [new BackstagePassesItem("Backstage passes to a TAFKAL80ETC concert", 5, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(43, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSixAndNotMoreThanFifty() {
        $items = [new BackstagePassesItem("Backstage passes to a TAFKAL80ETC concert", 6, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFiveAndNotMoreThanFifty() {
        $items = [new BackstagePassesItem("Backstage passes to a TAFKAL80ETC concert", 5, 48)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testBackstagePassesQualityDropsToZeroAfterConcert() {
        $items = [new BackstagePassesItem("Backstage passes to a TAFKAL80ETC concert", 0, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->getQuality());
    }

    public function testBackstagePassesQualityIncreaseQualityByOneWhenDateIsMoreThan10() {
        $items = [new BackstagePassesItem("Backstage passes to a TAFKAL80ETC concert", 11, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(41, $items[0]->getQuality());
    }
}
