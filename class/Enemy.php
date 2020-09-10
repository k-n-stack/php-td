<?php

class Enemy {

    private $enemyNb;
    private $name;
    private $healthPoint;
    private $attackPoint;

    private $path = ['6x9','6x8','6x7','6x6','6x5','5x5','4x5','3x5','2x5','2x4','2x3','2x2','3x2','4x2','4x3','5x3','6x3','7x3','8x3','8x2','8x1'];
    private $pathPos;

    ### CONSTUCTOR

    function __construct($obName, $obHealthPoint, $obAttackPoint, $obEnemyNb, $obPathPos = 0) {

        $this->enemyNb = $obEnemyNb;
        $this->name = $obName;
        $this->healthPoint = $obHealthPoint;
        $this->attackPoint = $obAttackPoint;
        $this->pathPos = $obPathPos;

    }

    ### SETER

    function set_position(){

        if ($this->pathPos <= count($this->path) - 2) {
        $this->pathPos = $this->pathPos + 1;
        }
        
    }

    ### GETER

    public function get_name() {
        return $this->name;
    }

    function get_pathPos() {
        return $this->pathPos;
    }

    function get_path() {
        return $this->path;
    }

    function get_enemyNb() {
        return $this->enemyNb;
    }

    function get_positionY() {
        return substr($this->path[$this->pathPos],0,1);
    }

    function get_positionX() {
        return substr($this->path[$this->pathPos],2,1);
    }

    function get_attackPoint() {
        return $this->attackPoint;
    }

    function get_healthPoint() {
        return $this->healthPoint;
    }

    function set_healthPoint($value) {
        $this->healthPoint = $value;
    }

    ### METHOD

    public function placeOnLayout() {
        return '<div class="case enemy" id="l'.$this->get_positionY().'x'.$this->get_positionX().'"><img src="images\enemy1.png" height="30" width="30">hp:'.$this->healthPoint.'</div>';
    }
    
    public function attack() {

    }
}