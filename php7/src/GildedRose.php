<?php

namespace App;

final class GildedRose {

    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    public function updateQuality() {
        foreach ($this->items as $item) {
            if ($item->name == 'Aged Brie') {
                $this->increaseQuality($item);

                $item->sell_in = $item->sell_in - 1;

                if ($item->sell_in < 0) {
                    $this->increaseQuality($item);
                }
            } else if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                $this->increaseQuality($item);
                if ($item->sell_in < 11) {
                    $this->increaseQuality($item);
                }
                if ($item->sell_in < 6) {
                    $this->increaseQuality($item);
                }

                $item->sell_in = $item->sell_in - 1;

                if ($item->sell_in < 0) {
                    $item->quality = $item->quality - $item->quality;
                }
            } else if ($item->name == 'Sulfuras, Hand of Ragnaros') {

            } else {
                $this->decreaseQuality($item);
                $item->sell_in = $item->sell_in - 1;

                if ($item->sell_in < 0) {
                    $this->decreaseQuality($item);
                }
            }
        }
    }

    private function increaseQuality($item) {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }

    private function decreaseQuality($item) {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }
}

