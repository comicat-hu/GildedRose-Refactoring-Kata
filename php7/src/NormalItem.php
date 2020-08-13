<?php

namespace App;

class NormalItem extends Item {
    
    public function update() {
        $this->decreaseQuality();
        $this->sell_in = $this->sell_in - 1;

        if ($this->sell_in < 0) {
            $this->decreaseQuality();
        }
    }
}