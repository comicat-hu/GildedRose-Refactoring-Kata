<?php

namespace App;

use App\ItemFactory;

class GildedRoseTest extends \PHPUnit\Framework\TestCase {
    public function testFoo() {
        $items      = [ItemFactory::create("foo", 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $items[0]->getName());
    }

    public function testQualityNeverIsNegative() {
        $items      = [ItemFactory::create("foo", 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->getQuality());     
    }

    public function testSulfurasCouldNotBeSold() {
        $items = [ItemFactory::create("Sulfuras, Hand of Ragnaros", 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(10, $items[0]->getSellIn());
    }

    public function testSulfurasCouldNotDecreaseQuality() {
        $items = [ItemFactory::create("Sulfuras, Hand of Ragnaros", 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(10, $items[0]->getQuality());
    }

    public function testQualityCouldNotBeMoreThanFifty() {
        $items = [ItemFactory::create("Aged Brie", 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testItemWithDatePassedQualityDecreaseByTwice() {
        $items = [ItemFactory::create("foo", -1, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(38, $items[0]->getQuality());
    }

    public function testAgedBrieIncreaseQualityWhenItGetsOlder() {
        $items = [ItemFactory::create("Aged Brie", 1, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(41, $items[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassed() {
        $items = [ItemFactory::create("Aged Brie", -1, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(42, $items[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassedAndNotMoreThanFifty() {
        $items = [ItemFactory::create("Aged Brie", -1, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanTen() {
        $items = [ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 10, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(42, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSix() {
        $items = [ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 6, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(42, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFive() {
        $items = [ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 5, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(43, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSixAndNotMoreThanFifty() {
        $items = [ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 6, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFiveAndNotMoreThanFifty() {
        $items = [ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 5, 48)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->getQuality());
    }

    public function testBackstagePassesQualityDropsToZeroAfterConcert() {
        $items = [ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 0, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->getQuality());
    }

    public function testBackstagePassesQualityIncreaseQualityByOneWhenDateIsMoreThan10() {
        $items = [ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 11, 40)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(41, $items[0]->getQuality());
    }
}
