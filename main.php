<?php

require_once 'html_templates\head.php';
require_once 'html_templates\map.php';
require_once 'html_templates\zone.php';
require_once 'html_templates\UI_pannel.php';
require_once 'html_templates\foot.php';
require_once 'html_templates\gameover.php';

require_once 'class\UserInterface.php';
require_once 'class\Enemy.php';
require_once 'class\Tower.php';
require_once 'class\ObjectPooler.php';

require_once 'object\towerlist.php';


session_start();

// echo "post : ";
// var_dump($_POST);
// echo "||| ";
// echo "session turn : ";
// var_dump($_SESSION['turn']);
// echo "\n";
// var_dump($_SESSION['OP']);

// function emptyNotExist($value) {
//     return !isset($value) or empty($value);
// }

// function existNotEmpty($value) {
//     return isset($value) or !empty($value);
// }



$restrictedcoord = array (
[2,2], [2,3], [2,4], [2,5],
[3,2], [3,5],
[4,1], [4,2], [4,3], [4,4], [4,5], [4,6], [4,7], [4,8], [4,9],
[5,1], [5,2], [5,3], [5,4], [5,5], [5,6], [5,7], [5,8], [5,9],
[6,3], [6,5], [6,6], [6,7], [6,8], [6,9],
[7,3],
[8,1], [8,2], [8,3]
);
###################################################################

if ( !isset($_SESSION['UI']) or empty($_SESSION['UI']) ) {
    $_SESSION['UI'] = new UserInterface(100, 250);
}

if ( !isset($_SESSION['OP']) or empty($_SESSION['OP']) ) {
    $_SESSION['OP'] = new ObjectPooler();
}

if ( !isset($_SESSION['turn']) or empty($_SESSION['turn']) ) {
    $_SESSION['turn'] = 0;  
}

if ( !isset($_SESSION['spawned']) or empty($_SESSION['spawned']) ) {
    $_SESSION['spawned'] = false;
}

if ( isset($_POST['submit']) or !empty($_POST['submit']) ) {
    $_SESSION['OP']->attackEnemyInRange();
}

if ( isset($_POST['submit']) or !empty($_POST['submit']) ) {
    foreach ($_SESSION['OP'] as $value) {
        if ($value instanceof Enemy) {
            if ($value->get_healthPoint() <= 0) {
                $_SESSION['OP']->kill_Enemy( "enemy".$value->get_enemyNb() );
                $_SESSION['UI']->winGold(15);
            }
        }
    }
}
####################################################################
// var_dump($_POST);
// if ( isset($_SESSION['towertype']) or !empty($_SESSION['towertype']) ) {
//     if ( $_SESSION)
// }




####################################################################

if ( isset($_POST['submit']) or !empty($_POST['submit']) ) {

    if ($_POST['submit'] == "next_turn") {

        foreach ($_SESSION['OP'] as $value) {
            if ($value instanceof Enemy) {
                // if (is_object($value)) {
                    $value->set_position();
                // }
            }
        }

        $_SESSION['turn']++;
        $_SESSION['spawned'] = false;
    }    
}

####################################################################

$waveManager = [1,3,4,6,7,8,12,13,14,15,16,19,22,23,24,25,26,27];

foreach ($waveManager as $value) {
    if ($_SESSION['turn'] == $value) {
        if ($_SESSION['spawned'] == false) {
            $_SESSION['OP']->set_Enemy('test',250,15);
            $_SESSION['spawned'] = true;
            echo "yo";
        }
    }
}

####################################################################

if ( isset($_SESSION['OP']) or !empty($_SESSION['OP']) ) {
    foreach ( $_SESSION['OP'] as $value ) {
        if ($value instanceof Enemy) {
            if ( $value->get_pathPos() == count( $value->get_path() ) - 1 ) {
                
                $_SESSION['OP']->kill_Enemy( "enemy".$value->get_enemyNb() );
                $_SESSION['UI']->takeDamage( $value->get_attackPoint() );

                if ( $_SESSION['UI']->get_lifePoint() <= 0 ) {
                    print_GameOver();
                    exit;
                }

            }
        }
    }
}

####################################################################

for ( $y=1 ; $y<=9 ; $y++ ) {
    for ( $x=1 ; $x<=9 ; $x++ ) {
        if ( isset($_POST['m'.$y.'x'.$x]) or !empty($_POST['m'.$y.'x'.$x]) ) {
            if ( $_POST['m'.$y.'x'.$x] == 'show' ) {
                echo 'hello m'.$y.'x'.$x;
                $isSelection = true;
                $_SESSION['sessionPosY'] = $y;
                $_SESSION['sessionPosX'] = $x;
            }
        } 
    }
}

if ( isset($_POST['towertype']) or !empty($_POST['towertype']) ) {
    foreach ($restrictedcoord as $value) {
        if ($value[0] == $_SESSION['sessionPosY'] and $value[1] == $_SESSION['sessionPosX']) {
            echo 'impossible to construct here';
            goto here;
        }
    }
}


if ( isset($_POST['towertype']) or !empty($_POST['towertype']) ) {

    foreach ($_SESSION['OP'] as $value) {
        if ($value instanceof Tower) {
            if ($value->get_positionY() == $_SESSION['sessionPosY'] and $value->get_positionX() == $_SESSION['sessionPosX']) {
                echo 'impossible to construct here';
                goto here;
            }
        }
    }

    switch ($_POST['towertype']) {

        case 'build_arrow_tower' :

            if ( $_SESSION['UI']->get_gold() < $arrowTower->get_buildCost() ) {
                echo 'not enough gold';
                break;
            }

            $_SESSION['OP']->set_Tower( $arrowTower->get_name(), $arrowTower->get_buildCost(), $arrowTower->get_attackPower(), $arrowTower->get_range(), $_SESSION['sessionPosY'], $_SESSION['sessionPosX'] );
            $_SESSION['UI']->buyTower( $arrowTower->get_buildCost() );
            echo 'arrow build';
            break;

        case 'build_fire_tower' :

            if ( $_SESSION['UI']->get_gold() < $fireTower->get_buildCost() ) {
                echo 'not enough gold';
                break;
            }

            $_SESSION['OP']->set_Tower( $fireTower->get_name(), $fireTower->get_buildCost(), $fireTower->get_attackPower(), $fireTower->get_range(), $_SESSION['sessionPosY'], $_SESSION['sessionPosX'] );
            $_SESSION['UI']->buyTower( $fireTower->get_buildCost() );
            echo 'fire build';
            break;

        case 'build_lazer_tower' :

            if ( $_SESSION['UI']->get_gold() < $lazerTower->get_buildCost() ) {
                echo 'not enough gold';
                break;
            }

            $_SESSION['OP']->set_Tower( $lazerTower->get_name(), $lazerTower->get_buildCost(), $lazerTower->get_attackPower(), $lazerTower->get_range(), $_SESSION['sessionPosY'], $_SESSION['sessionPosX'] );
            $_SESSION['UI']->buyTower( $lazerTower->get_buildCost() );
            echo 'lazer build';
            break;

    }
}

here:

####################################################################

print_Head();
print_Map();

$_SESSION['OP']->print_Layout();

echo '|||||||||||||||||||||||||||||||||||||||||||| gold : '.$_SESSION['UI']->get_gold();

print_Zone();
print_UI();
print_Foot();

// echo "post : ";
// var_dump($_POST);
// echo $_SESSION['UI']->get_gold().'||||||||';
// echo "||| ";
// echo "session turn : ";
// var_dump($_SESSION['turn']);
// echo "\n";
// var_dump($_SESSION['OP']);

?>