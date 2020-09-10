<?php

function print_UI() {

// if ( isset($_POST['submit']) or !empty($_POST['submit']) ) {
//     if ($_POST['submit'] == "next_turn") {

//         echo <<< UI
//         <div id='inputpanel'>
        
//             <div id='action'>
//                 <form action="main.php" method="post">
//                     <input type="submit" name="submit" value="next_turn">
//                 </form>
//             </div>
// UI;
//     }
// }

$mapClicked = true;

echo '<div id="inputpanel">';

echo <<< UI
    <div id='stat'>
    </div>
UI;

for ( $y=1 ; $y<=9 ; $y++ ) {
    for ( $x=1 ; $x<=9 ; $x++ ) {
        if ( isset($_POST['m'.$y.'x'.$x]) or !empty($_POST['m'.$y.'x'.$x]) ) {
            if ( $_POST['m'.$y.'x'.$x] == 'show' ) {
                echo <<< UI
                <div id='action'>
                    <form action="main.php" method="post">
                        <input class="actioninput" type="submit" name="towertype" value="build_arrow_tower"><br/>
                        <input class="actioninput" type="submit" name="towertype" value="build_fire_tower"><br/>
                        <input class="actioninput" type="submit" name="towertype" value="build_lazer_tower"><br/>
                        <input class="actioninput" type="submit" name="cancel" value="CANCEL"><br/>
                    </form>
                </div>
UI;
                goto here;#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
            }
        } 
    }
}

echo <<< UI
    <div id='action'>
        <form action="main.php" method="post">
            <input type="submit" name="submit" value="next_turn">
        </form>
    </div>
UI;
// }

here:#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

echo <<< UI
</div>
UI;
}