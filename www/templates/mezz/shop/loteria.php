<form method="POST">
    <div class="loteria-inputs">
        <input
            type="number"
            min="1"
            max="10"
            placeholder="1-10"
            name="num1"
            class="loteria-input"
            required
            autocomplete="off">

        <input
            type="number"
            min="1"
            max="10"
            placeholder="1-10"
            name="num2"
            class="loteria-input"
            required
            autocomplete="off">
    </div>

    <button class="loteria-btn" type="submit" name="comprarloteria">
        <?= $lang["loteriabotton"] ?>: <?= $config['precioloteria'] ?>
        <img src="/assets/images/shop/esmeralda.png">
    </button>
</form>

<?php
$premioloteria = $config['precioloteria'] * 2;
if (User::userData('online') == "0") {
    if (isset($_POST["comprarloteria"])) {
        if (!empty($_POST['num1'])) {
            if (!empty($_POST['num2'])) {
                if (User::userData('activity_points') >= $config['precioloteria']) {

                    $num1 = $_POST['num1'];
                    $num2 = $_POST['num2'];
                    $aletorio1 = rand(1, 10);
                    $aletorio2 = rand(1, 10);
                    echo "<div class='successhop' style='text-align: center; margin-top: 20px; font-weight: 600;'>" . $lang["tusnumerosloteria"] . " " . $num1 . " y " . $num2 . "</div>";

                    if (($num1 == $aletorio1  and $num2 == $aletorio2) or ($num1 == $aletorio2 and $num2 == $aletorio1)) {

                        $addloteria = $dbh->prepare("UPDATE users SET activity_points=activity_points+" . $premioloteria . " WHERE id=" . User::userData('id'));
                        $addloteria->execute();

                        echo "<div class='successhop' style='text-align: center; color: #059669;'>" . $lang["Loteriasucces"] . " " . $aletorio1 . " y " . $aletorio2 . "</div>"; //Aqui es el codigo de que gano los 2 numeros

                    } else {

                        if (($num1 == $aletorio1) or ($num1 == $aletorio2)) {
                            echo "<div class='successhop' style='text-align: center; color: #059669;'>" . $lang["Loterianumsolo"] . " " . $aletorio1 . " y " . $aletorio2 . "</div>";
                        } else {

                            if (($num2 == $aletorio2) or ($num2 == $aletorio1)) {
                                echo "<div class='successhop' style='text-align: center; color: #059669;'>" . $lang["Loterianumsolo"] . " " . $aletorio1 . " y " . $aletorio2 . "</div>";
                            } else {

                                $addloteria = $dbh->prepare("UPDATE users SET activity_points=activity_points-" . $config['precioloteria'] . " WHERE id=" . User::userData('id'));
                                $addloteria->execute();

                                echo "<div class='errorshop' style='background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-top: 20px; text-align: center; border: 1px solid #fecaca;'>" . $lang["Loterianogano"] . " " . $aletorio1 . " y " . $aletorio2 . "</div>"; //Aqui el codigo si no gano nada
                            }
                        }
                    }
                } else {
                    echo "<div class='errorshop' style='background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-top: 20px; text-align: center; border: 1px solid #fecaca;'>" . $lang["shoperror1"] . "</div>";
                }
            } else {
                echo "<div class='errorshop' style='background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-top: 20px; text-align: center; border: 1px solid #fecaca;'>" . $lang["invalidnum2"] . "</div>";
            }
        } else {
            echo "<div class='errorshop' style='background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-top: 20px; text-align: center; border: 1px solid #fecaca;'>" . $lang["invalidnum1"] . "</div>";
        }
    }
} else {
    if (isset($_POST["comprarloteria"])) {
        echo "<div class='errorshop' style='background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-top: 20px; text-align: center; border: 1px solid #fecaca;'>" . $lang["shoperror3"] . "</div>";
    }
}

?>