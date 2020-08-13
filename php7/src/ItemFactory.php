<?php

namespace App;

final class ItemFactory {
    static public function create($name, $sell_in, $quality) {
        switch ($name) {
            case 'Aged Brie':
                return new AgedBrieItem($name, $sell_in, $quality);
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                return new BackstagePassesItem($name, $sell_in, $quality);
                break;
            case 'Sulfuras, Hand of Ragnaros':
                return new SulfurasItem($name, $sell_in, $quality);
                break;
            default:
                return new NormalItem($name, $sell_in, $quality);
                break;
        }
    } 
}