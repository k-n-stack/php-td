<?php

class Tower {

    private $name;
    private $posX;
    private $posY;
    private $buildCost;
    
    private $attackPower;
    private $range;

    function __construct($obName, $obBuildCost, $obattackPower, $obRange, $obPosY, $obPosX) {

        $this->name = $obName;
        $this->posY = $obPosY;
        $this->posX = $obPosX;

        $this->buildCost = $obBuildCost;
        $this->attackPower = $obattackPower;
        $this->range = $obRange;

    }

    public function get_name() {
        return $this->name;
    }

    public function get_positionY() {
        return $this->posY;
    }

    public function get_positionX() {
        return $this->posX;
    }

    public function get_buildCost() {
        return $this->buildCost;
    }

    public function get_attackPower() {
        return $this->attackPower;        
    }

    public function get_range() {
        return $this->range;
    }

    public function placeOnLayout() {

        if ($this->name == 'Arrow_Tower') {
            return '<div class="case tower" id="l'.$this->get_positionY().'x'.$this->get_positionX().'"><img src="images\arrow.png" height="30" width="30">atk:'.$this->attackPower.'</div>';
        }

        if ($this->name == 'Fire_Tower') {
            return '<div class="case tower" id="l'.$this->get_positionY().'x'.$this->get_positionX().'"><img src="images\fire.png" height="30" width="30">atk:'.$this->attackPower.'</div>';
        }

        if ($this->name == 'Lazer_Tower') {
            return '<div class="case tower" id="l'.$this->get_positionY().'x'.$this->get_positionX().'"><img src="images\lazer.png" height="30" width="30">atk:'.$this->attackPower.'</div>';
        }

    }

    public function zoneCalculation() {

        if ( $this->get_positionY() - $this->get_range() < 1 ) {
            $minY = 1;
        } else {
            $minY = $this->get_positionY() - $this->get_range();
        }

        if ( $this->get_positionY() + $this->get_range() > 9 ) {
            $maxY = 9;
        } else {
            $maxY = $this->get_positionY() + $this->get_range();
        }
        
        if ( $this->get_positionX() - $this->get_range() < 1 ) {
            $minX = 1;
        } else {
            $minX = $this->get_positionX() - $this->get_range();
        }

        if ( $this->get_positionX() + $this->get_range() > 9 ) {
            $maxX = 9;
        } else {
            $maxX = $this->get_positionX() + $this->get_range();
        }

        return [[$minY,$maxY],[$minX,$maxX]];

    }

    public function print_TowerZone() {

        echo '<div class="range">';
        // var_dump($this->zoneCalculation());
        // echo $this->get_range();

        for ( $y=1 ; $y<=9 ; $y++ ) {
            for ( $x=1 ; $x<=9 ; $x++ ) {

                if ( $y < $this->zoneCalculation()[0][0] or $y > $this->zoneCalculation()[0][1] ) {
                    echo '<div id="r'.$y.'x'.$x.'" class="case"></div>';
                }
                elseif ($x < $this->zoneCalculation()[1][0] or $x > $this->zoneCalculation()[1][1] ) {
                    echo '<div id="r'.$y.'x'.$x.'" class="case"></div>';
                }
                else {
                    echo '<div id="r'.$y.'x'.$x.'" class="towerzone case"></div>';
                }
            }
        }

        echo '</div>';
    
    }

    function show() {

        echo "Tour : $this->name.</br>";
        echo "Level : $this->level.</br>";
        echo "PosX : $this->posX, PosY : $this->posY.</br>";
        echo "Cost : $this->buildCost.</br>";
        echo "Attack-Power : $this->attackPower.</br>";
        echo "Range ; $this->range.</br>";
        
    }
    
}