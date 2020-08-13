<?php

namespace App;

class BackstagePassesItem extends Item {
    
    public function update() {
        $this->increaseQuality();
        if ($this->sell_in < 11) {
            $this->increaseQuality();
        }
        if ($this->sell_in < 6) {
            $this->increaseQuality();
        }

        $this->sell_in = $this->sell_in - 1;

        if ($this->sell_in < 0) {
            $this->quality = 0;
        }
    }
}