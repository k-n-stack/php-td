<?php

function print_Zone() {

    $printTowerZone = false;

    echo '<div class="zone">';


    for ( $y=1 ; $y<=9 ; $y++ ) {
        for ( $x=1 ; $x<=9 ; $x++ ) {

            if ( isset($_POST['m'.$y.'x'.$x]) or !empty($_POST['m'.$y.'x'.$x]) ) {
                echo '<div id="z'.$y.'x'.$x.'" class="selection"></div>';

                foreach ( $_SESSION['OP'] as $value) {

                    if ( $value instanceof Enemy or $value instanceof Tower ) {

                        if ( $value->get_positionY() == $y and $value->get_positionX() == $x ) {
                            // echo $value->get_name(); ##########################################################################

                            if ($value instanceof Tower) {
                                $targetTower = $value;
                                $printTowerZone = true;
                            }

                        }

                    }

                }

            }

            else {

                echo '<div id="z'.$y.'x'.$x.'" class="case"></div>';

            }

        }

    }

    echo '</div>';

    if ($printTowerZone) {

        $targetTower->print_TowerZone();

    }

}