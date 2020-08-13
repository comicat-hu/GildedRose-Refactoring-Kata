<?php

namespace App;

class AgedBrieItem extends Item {
    
    public function update() {
        $this->increaseQuality();

        $this->sell_in = $this->sell_in - 1;

        if ($this->sell_in < 0) {
            $this->increaseQuality();
        }
    }
}