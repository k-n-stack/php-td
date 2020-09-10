<?php

class UserInterface {

    private $lifePoint;
    private $gold;

    function __construct($obLifePoint,$obGold) {

        $this->lifePoint = $obLifePoint;
        $this->gold = $obGold;

    }

    function get_lifePoint() {
        return $this->lifePoint;
    }

    function get_gold() {
        return $this->gold;
    }

    function buyTower($cost) {
        if ( $this->gold - $cost < 0 ) {
            echo 'not enough gold'; ################################################
        }
        else {
            $this->gold -= $cost;
        }
    }

    function winGold($loot) {
        $this->gold += $loot;

    }

    function takeDamage($attackPoint) {
        $this->lifePoint -= $attackPoint;
    }

    function decreaseLife() {

    }

    function spendGold() {

    }
    
}