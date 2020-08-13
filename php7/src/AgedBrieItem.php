<?php

namespace App;

class AgedBrieItem extends Item {
    
    public function update() {
        $this->increaseQuality();

        $this->decreaseSellIn();
        if ($this->getSellIn() < 0) {
            $this->increaseQuality();
        }
    }
}