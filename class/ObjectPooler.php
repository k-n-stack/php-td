<?php

require_once 'class\Enemy.php';
require_once 'class\Tower.php';

class ObjectPooler {

    private $wave = 1;
    private $towerNb = 1;

    function __construct() {

    }

    function kill_Enemy($obEnemy) {
        unset($this->$obEnemy);
    }

    function set_Enemy($obName, $obHealthPoint, $obAttackPoint) {
        $atrName = "enemy".$this->wave;
        $this->$atrName = new Enemy($obName, $obHealthPoint, $obAttackPoint, $this->wave);
        $this->wave++;
    }

    function set_Tower($obName, $obBuildCost, $obattackPower, $obRange, $obPosY, $obPosX) {
        $atrName = $obName.$this->towerNb;
        $this->$atrName = new Tower($obName, $obBuildCost, $obattackPower, $obRange, $obPosY, $obPosX);
        $this->towerNb++;
    }

    function print_Layout() {

        echo '<div class="layout">';

        for ( $y=1 ; $y<=9 ; $y++ ) {
            for ( $x=1 ; $x<=9 ; $x++ ) {

                $isObject = false;

                foreach ($this as $value) {
                    if ($value instanceof Enemy or $value instanceof Tower) {
                        if ( $y == $value->get_positionY() and $x == $value->get_positionX() ) {

                            $isObject = true;

                                if ($value instanceof Enemy) {
                                    echo $value->placeOnLayout();
                                }
            
                                if ($value instanceof Tower) {
                                    echo $value->placeOnLayout();
                                }
                                
                            
                        }
                    }
                }

                if ( $isObject == false ) {

                    if ( $y == 8 and $x == 1 ) {
                        echo '<div class="case homelayout" id="l'.$y.'x'.$x.'"><img src="images\home.png" height="40" width="50">hp : '.$_SESSION['UI']->get_lifePoint().'</div>';
                    }
                    else {
                        echo '<div class="case" id="l'.$y.'x'.$x.'"></div>';
                    }
                }
    
            }

        }
    
        echo '</div>';
    
    }

    function attackEnemyInRange() {

        foreach ($this as $tower) {

            if ($tower instanceof Tower) {

                foreach ($this as $enemy) {

                    if ($enemy instanceof Enemy) {

                        // var_dump($tower->zoneCalculation());

                        $yInRange = false;
                        $xInRange = false;

                        if ( ($enemy->get_positionY() >= $tower->zoneCalculation()[0][0] and $enemy->get_positionY() <= $tower->zoneCalculation()[0][1]) ) {
                            $yInRange = true;
                        }

                        if ( ($enemy->get_positionX() >= $tower->zoneCalculation()[1][0] and $enemy->get_positionX() <= $tower->zoneCalculation()[1][1]) ) {
                            $xInRange = true;
                        }

                        if ( $yInRange == true and $xInRange == true) {
                            $enemy->set_healthPoint($enemy->get_healthPoint() - $tower->get_attackPower());
                            echo $tower->get_name().' inflicted '.$tower->get_attackPower().' to '.$enemy->get_name().$enemy->get_enemyNb().'||||||';
                            
                        }
                    }
                }
            }
        }
    }
}