<?php

namespace App;

abstract class Item {

    private $name;
    private $sell_in;
    private $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name    = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    public function getName() {
        return $this->name;
    }

    public function getSellIn() {
        return $this->sell_in;
    }

    public function setSellIn($sell_in) {
        return $this->sell_in = $sell_in;
    }

    public function getQuality() {
        return $this->quality;
    }

    public function setQuality($quality) {
        $this->quality = $quality;
    }

    public function increaseQuality() {
        if ($this->quality < 50) {
            $this->quality ++;
        }
    }

    public function decreaseQuality() {
        if ($this->quality > 0) {
            $this->quality --;
        }
    }

    public function decreaseSellIn() {
        $this->sell_in --;
    }

    abstract function update();
}

